<?php
$config = require __DIR__ . '/config.php';
$rout = $_GET['rout'] ?? '';
$webRout = $config['webRout'];
$baseDir = $config['baseDir'];
$actualRout = $baseDir;
if($rout) {
    $actualRout = realpath("{$baseDir}/{$rout}");
}

if(mb_strlen($baseDir) > mb_strlen($actualRout)) {
    exit('You haven`t access to private zone...');
}

$actualDir = $actualRout;
$actualInsideRout = ltrim(str_replace($baseDir, '', $actualRout),'/');
$content = 'File isn`t selected';

if(is_file($actualRout)) {
    $mimeType = mime_content_type($actualRout);
    switch($mimeType){
        case 'text/plain':
            $content = nl2br(file_get_contents($actualRout));
            break;
        case 'image/png':
        case 'image/jpeg':
            $content = "<img src='{$webRout}/{$actualInsideRout}'>";
            break;
        default:
            $content = <<< text
            File can`t be opened<br>
            Try to <a href="downloadFile.php?rout={$actualInsideRout}" target="_blank">download</a> it
            text;
    }
    $actualDir = dirname($actualRout);
    $actualInsideRout = ltrim(dirname($actualInsideRout), '/');
}

$dirData = scandir($actualDir);
if($actualDir === $baseDir) {
    $dirData = array_filter($dirData, static function($test){
       return !in_array($test, ['.', '..']);
    });
} else {
    $dirData = array_filter($dirData, static function($test){
        return !in_array($test, ['.']);
    });
}

$explodeActualInsideRout = explode('/', $actualInsideRout);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="1" width="100%" cellpadding="20">
    <tr>
        <td valign="top" width="25%">
            <a href="?rout=">storage</a>
            <?php foreach ($explodeActualInsideRout as $explode) : ?>
            <?php
            $exp = '';
                $count = 0;
                while($explodeActualInsideRout[$count] !== $explode) {
                    $exp .= $explodeActualInsideRout[$count] . '/';
                    $count++;
                }
                $trim = rtrim($exp, '/');
                ?>
                / <a href="?rout=<?= "{$trim}/{$explode}"  ?>"><?= $explode ?></a>
            <?php endforeach; ?>
            <hr style="margin: 5px 0 15px">
            <form action="create_directory.php" method="post">
                <input name="actualInsideRout" value="<?= $actualInsideRout ?>" type="hidden">
                <input name="name" type="text">
                <button type="submit">Create directory</button>
            </form>
            <form action="uploadFiles.php" method="post" enctype="multipart/form-data">
                <input name="actualInsideRout" type="hidden" value="<?= $actualInsideRout ?>">
                <input style="margin: 10px 0 10px" name="file[]" type="file" multiple>
                <div>
                <button type="submit">Upload</button>
                </div>
            </form>
            <ul>
            <?php foreach ($dirData as $element) : ?>
                <form action="delete_directory.php" method = "post">
                    <li style="padding-bottom: 10px">
                        <a style="margin-right: 10px" href="?rout=<?= "{$actualInsideRout}/{$element}" ?>"><?= $element ?></a>
                        <input name="actualInsideRout" value="<?= $actualInsideRout ?>" type="hidden">
                        <input name="deleteDir" value="<?= $element ?>" type="hidden">
                        <?php if($element !== '..') : ?>
                        <button type="submit" >Delete</button>
                        <?php endif; ?>
                    </li>
                </form>
            <?php endforeach; ?>
            </ul>
        </td>
        <td align="center">
            <?= $content ?>
        </td>
    </tr>
</table>
</body>
</html>
