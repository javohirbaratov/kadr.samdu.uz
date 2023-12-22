<html>
    <body>
    	<br><br><br><br><br><br>
    	<input type="text" id="name">
    	<input type="text" id="text">
        <button onclick="generate()">Generate document</button>
    </body>
    <script>
    	includeJs('https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.28.5/docxtemplater.js');
    	includeJs('https://unpkg.com/pizzip@3.1.1/dist/pizzip.js');
    includeJs('https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js');
    includeJs('https://unpkg.com/pizzip@3.1.1/dist/pizzip-utils.js');



        function includeJs(jsFilePath) {
		    var js = document.createElement("script");
		    js.type = "text/javascript";
		    js.src = jsFilePath;
		    document.body.appendChild(js);
		}

		
        function loadFile(url, callback) {
            PizZipUtils.getBinaryContent(url, callback);
        }
        function generate() {
        	var name = document.getElementById('name').value;
        	var text = document.getElementById('text').value;
            loadFile(
                "1.docx",
                function (error, content) {
                    if (error) {
                        throw error;
                    }
                    var zip = new PizZip(content);
                    var doc = new window.docxtemplater(zip, {
                        paragraphLoop: true,
                        linebreaks: true,
                    });
                    doc.render({
                        first_name:text,
                        name: name,
                    });
                    var out = doc.getZip().generate({
                        type: "blob",
                        mimeType:
                            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                    });
                    // Output the document using Data-URI
                    saveAs(out, "output.docx");
                }
            );
        }


    </script>
</html>