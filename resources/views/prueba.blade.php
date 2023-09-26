{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
    <title>Document</title>
</head>

<body>
    <img src="{{asset('/img/Alfombra de Fashion Lounge de BCBGMAXAZRIA/ENTREFAM52105384_.jpg')}}" id="img1" style="width: 250px" />

    <br />
</body>
<script>
    window.onload = getExif;

    function getExif() {
        var img1 = document.getElementById("img1");
        EXIF.getData(img1, function() {
            var MetaData = EXIF.getAllTags(this);
            console.log(JSON.stringify(MetaData, null, "\t"));
        });
    }
</script>

</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<img src="{{ asset('/img/Alfombra de Fashion Lounge de BCBGMAXAZRIA/ENTREFAM52105384_.jpg') }}" id="img1"
    style="width: 200px" />
<pre>Make and model: <span id="makeAndModel"></span></pre>
<br />
<img src="{{ asset('/img/Alfombra de Fashion Lounge de BCBGMAXAZRIA/ENTREFAM52105384_.jpg') }}" id="img2"
    style="width: 200px" />
<pre id="allMetaDataSpan"></pre>
<br />

<body>

</body>
<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
<script>
    window.onload = getExif;

    function getExif() {
        var img1 = document.getElementById("img1");
        EXIF.getData(img1, function() {
            var make = EXIF.getTag(this, "Object Name");
            var model = EXIF.getTag(this, "ImageDescription");
            var makeAndModel = document.getElementById("makeAndModel");
            makeAndModel.innerHTML = `${make} ${model}`;
        });

        var img2 = document.getElementById("img2");
        EXIF.getData(img2, function() {
            var allMetaData = EXIF.getAllTags(this);
            var allMetaDataSpan = document.getElementById("allMetaDataSpan");
            allMetaDataSpan.innerHTML = JSON.stringify(allMetaData, null, "\t");
        });
    }
</script>

</html>
