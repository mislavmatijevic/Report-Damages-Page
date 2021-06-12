<?php
$pageAccessLvl = 3;
$pageTitle = "Prijava štete";
require_once './control/_page.php';

$publicCallId;
$newDamage;
$materialTypes;
$mistakeField = array();

try {
    $dbObj = new DB();
    $materialTypes = $dbObj->SelectPrepared("SELECT * FROM vrsta_materijala");
    $smarty->assign("materialTypes", $materialTypes);
} catch (Exception $e) {
    $smarty->assign("errorGlobal", $e->getMessage());
}

if (isset($_POST["public-call-identifier"]) && isset($_POST["submit"])) {
    $publicCallId = Prevent::Injection("POST", "public-call-identifier");
    settype($publicCallId, "integer");

    $isValidCaptcha = false;
    try {
        $isValidCaptcha = UserControl::CheckCaptcha($_POST['g-recaptcha-response']);
    } catch (Exception $e) {
        $smarty->assign("messageCaptcha", $e->getMessage());
    }
    
    if ($isValidCaptcha) { // Kod za prijavu štete.
        
        foreach ($_POST as $key => $value) {
            $newDamage[$key] = Prevent::Injection("POST", $key);

            switch ($key) {
                case "name":
                    if (strlen($value) < 3) {
                        $mistakeField[$key] = "Naziv prekratak.";
                    } elseif (strlen($value) > 45) {
                        $mistakeField[$key] = "Naziv predugačak.";
                    }
                    break;

                case "description":
                    if (strlen($value) < 3) {
                        $mistakeField[$key] = "Opis prekratak. Unesite detaljan opis štete o kojoj je riječ kako bi moderator lakše mogao ocijeniti Vašu prijavu. Što bolji utisak ostavite svojim opisom, to su veće šanse da dobijete veću subvenciju!";
                    }
                    break;
                
                case "tags":
                    $tags = explode(" ", $value);
                    if (count($tags) < 2) {
                        $mistakeField[$key] = "Unesite barem dvije oznake.";
                    } elseif (strlen($value) > 100) {
                        $mistakeField[$key] = "Previše oznaka, skratite malo!";
                    }
                    break;
            }
        }

        $newDamage["files"] = array();
        foreach ($_FILES as $fileIdentificator => $fileInfoArray) {
            if (empty($fileInfoArray["name"])) continue;

            $fileMistakesString = "";
            $thisFileMaterial = explode("-", $fileIdentificator)[1]; // Prvo upišem oznaku datoteke "id_vrsta_materijal" koja je originalno pročitana iz baze.
            foreach ($materialTypes as $key => $value) {
                if ($value["id_vrsta_materijala"] == $thisFileMaterial) {
                    $thisFileMaterial = $value; // Tada upišem cijeli zapis vrste materijala iz baze u zapis ove datoteke.
                }
            }

            $maxAllowdSizeB = round($thisFileMaterial["najveca_velicina_mb"]*1024*1024);
            $thisFileSizeMb = round($fileInfoArray["size"]/1024/1024, 3);

            if ($fileInfoArray["size"] > $maxAllowdSizeB) {
                $fileMistakesString .=  "Veličina datoteke iznosi {$thisFileSizeMb}MB, a najviše dopušteno je {$thisFileMaterial["najveca_velicina_mb"]}";
            }

            if ($fileInfoArray["error"] > 0) {
                switch ($fileInfoArray["error"]) {
                    case 1:
                        $fileMistakesString .=  'Veličina veća od serverski definirane najveće: ' . ini_get('upload_max_filesize');
                        break;
                    case 2:
                        $fileMistakesString .=  'Prevelika datoteka.';
                        break;
                    case 3:
                        $fileMistakesString .=  'Datoteka djelomično prenesena.';
                        break;
                    case 4:
                        $fileMistakesString .=  'Datoteka nije prenesena.';
                        break;
                }
            }

            if (strlen($fileMistakesString[$fileIdentificator]) !== 0) {
                $mistakeField[$fileIdentificator] = $fileMistakesString . " ({$fileInfoArray["name"]})";
            }

            if (is_uploaded_file($fileInfoArray["tmp_name"])) {
                if ($fileInfoArray["type"] != $thisFileMaterial["ekstenzija"]) {
                    $mistakeField[$fileIdentificator] = $thisFileMaterial["naziv"] . " mora biti vrste " . $thisFileMaterial["ekstenzija"] . ", a ne " . $fileInfoArray["type"] . "!";
                } else {
                    $location = './media/evidence/';
                    if (move_uploaded_file($fileInfoArray["tmp_name"], $location . basename($fileInfoArray["name"])) == false) {
                        $mistakeField[$fileIdentificator] =  "Nije moguće prenijeti datoteku {$fileInfoArray["name"]} na odredište. ";
                    } else {
                        $newFieldObject->fileName= $fileInfoArray["name"];
                        $newFieldObject->fileType= $thisFileMaterial["id_vrsta_materijala"];
                        $newDamage["files"][] = $newFieldObject; // Datoteke se upisuju u polje "files", gdje svaka datoteka ima svoje polje s imenom i tipom.
                    }
                }
            }
        }

        if (count($newDamage["files"]) == 0) {
            $mistakeField["files"] = "Nijedna datoteka nije prenesena! Morate prenijeti barem jedan dokazni materijal o Vašoj šteti.";
        }

        if (!empty($mistakeField)) { // Sve je ok, treba unijeti nove podatke u bazu!
            $smarty->assign("mistakeField", Prevent::XSS($mistakeField));
        } else {
            try {
                $dbObj = new DB();
                $categoryId = $publicCallInfo = $dbObj->SelectPrepared("SELECT id_kategorija_stete FROM javni_poziv WHERE id_javni_poziv = ?", "i", [$publicCallId])[0]["id_kategorija_stete"];
                $newIndex = $dbObj->InsertDamage($publicCallId, $_SESSION["user"]->id_korisnik, $categoryId, $newDamage);
                $_SESSION["infoGlobal"] = "Vaša je šteta zabilježena pod šifrom $newIndex";
                header("Location: /index.php");
                exit();
            } catch (Exception $e) {
                $smarty->assign("errorGlobal", $e->getMessage());
            }
        }
    }
} elseif (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /index.php");
    exit();
} else {
    $publicCallId = Prevent::Injection("GET", 'id');
    settype($publicCallId, "integer");
}

if (isset($newDamage)) {
    $smarty->assign("newDamage", $newDamage);
}

try {
    $dbObj = new DB();
    $publicCallInfo = $dbObj->SelectPrepared("SELECT jp.id_javni_poziv, jp.naziv, jp.opis, jp.zatvoren, oo.korisnicko_ime as moderator, oo.email as moderator_email, k.ilustracija as kategorija_ilustracija FROM javni_poziv as jp INNER JOIN korisnik oo ON jp.id_odgovorna_osoba = oo.id_korisnik INNER JOIN kategorija_stete k ON jp.id_kategorija_stete = k.id_kategorija_stete WHERE jp.id_javni_poziv = ?", "i", [$publicCallId]);
    $publicCallInfo = $publicCallInfo[0];
    if ($publicCallId["zatvoren"] == 1) {
        throw new Exception("Ovaj je javni poziv istekao!");
    }
    $smarty->assign("publicCallInfo", $publicCallInfo);
} catch (Exception $e) {
    $smarty->assign("errorGlobal", $e->getMessage());
}

$smarty->display("header.tpl");
$smarty->display("report-damage.tpl");
$smarty->display("footer.tpl");
