download
========

Summary
---------
The download() function is used to trigger a file download from JavaScript. It specifies the contents and name of a new file placed in the browser's download directory. The input can be a String, Blob, or Typed Array of data, or via a dataURL representing the file's data as base64 or url-encoded string. No matter the input format, download() saves a file using the specified file name and mime information in the same manner as a server using a Content-Disposition HTTP header.

Syntax
---------

#### Via NPM/Bower 
`npm install downloadjs`  
`bower install downloadjs`

`require("downloadjs")(data, strFileName, strMimeType);`

#### Simple global `download` function via `<script>` include
    download(data, strFileName, strMimeType);

#### Included via AMD
    require(['path/to/file'], function(download) {
        download(data, strFileName, strMimeType);
    });


Parameters
---------
* **data** - The Blob, File, String, or dataURL containing the soon-to-be File's contents.
* **strFileName** - The name of the file to be created. Note that older browsers (like FF3.5, Ch5) don't honor the file name you provide, instead they automatically name the downloaded file.
* **strMimeType** - The MIME content-type of the file to download. While optional, it helps the browser present friendlier information about the download to the user, encouraging them to accept the download.



Example Usage
---------


### Plain Text
#### text string  -  [live demo](http://pagedemos.com/sxks39b72aqb/1)
    download("hello world", "dlText.txt", "text/plain");


#### text dataURL  -  [live demo](http://pagedemos.com/sxks39b72aqb/2)
    download("data:text/plain,hello%20world", "dlDataUrlText.txt", "text/plain");

#### text blob  -  [live demo](http://pagedemos.com/sxks39b72aqb/3)
    download(new Blob(["hello world"]), "dlTextBlob.txt", "text/plain");

#### text UInt8 Array -  [live demo](http://pagedemos.com/sxks39b72aqb/4)
    var str= "hello world",	arr= new Uint8Array(str.length);
    str.split("").forEach(function(a,b){
   	  arr[b]=a.charCodeAt();
    });

    download( arr, "textUInt8Array.txt", "text/plain" );

### HTML
#### html string -  [live demo](http://pagedemos.com/sxks39b72aqb/5)
    download(document.body.outerHTML, "dlHTML.html", "text/html");

#### html Blob -  [live demo](http://pagedemos.com/sxks39b72aqb/6)
    download(new Blob(["hello world".bold()]), "dlHtmlBlob.html", "text/html");

#### ajax callback -  [live demo](http://pagedemos.com/sxks39b72aqb/7)
    $.ajax({
    		url: "/download.html",
    		success: download.bind(true, "text/html", "dlAjaxCallback.html")
    });



Compatibility
---------
download.js works with a wide range of devices and browsers.

You can expect it to work for the vast majority of your users, with some common-sense limits:

* Devices without file systems like iPhone, iPad, Wii, et al. have nowhere to save the file to, sorry.
* Android support starts at 4.2 for the built-in browser, though chrome 36+ and firefox 20+ on android 2.3+ work well.
* Devices without Blob support won't be able to download Blobs or TypedArrays
* Legacy devices (no a[download]) support can only download a few hundred kilobytes of data, and can't give the file a custom name.
* Devices without window.URL support can only download a couple megabytes of data
* IE versions of 9 and before are NOT supported because the don't support a[download] or dataURL frame locations.


Change Log (v4)
---------
* 2008 :: landed a FF+Chrome compat way of downloading strings to local un-named files, upgraded to use a hidden frame and optional mime
* 2012 :: added named files via a[download], msSaveBlob() for IE (10+) support, and window.URL support for larger+faster saves than dataURLs
* 2014 :: added dataURL and Blob Input, bind-toggle arity, and legacy dataURL fallback was improved with force-download mime and base64 support
* 2015 :: converted to amd/commonJS module with browser-friendly fallback
* 20XX :: ???? Considering Zip, Tar, and other multi-file outputs, Blob.prototype.download option, and more, stay tuned folks.
