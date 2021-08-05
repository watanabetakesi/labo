<html>
<body>


<p>改行区切りでURLを入力してください</p>
<textarea id="url_list" cols="100" rows="10">
</textarea>

<p>
<button value="チェック" onclick="chekUrlList();">URL死活チェック</button>
</p>

<br>
<p>生きてるURL一覧</p>
<textarea id="result_list" cols="100" rows="10">
</textarea>


<script type="text/javascript">
function chekUrlList(){
	var url_list = document.getElementById("url_list").value;
	var ArrUrlList = url_list.split(/\r\n|\r|\n/);
	ArrUrlList.forEach(function (value, index, array) {
  		getUrlStatus(value);
	});
}


function getUrlStatus(target_url){

	console.log("Check Status ... " + target_url);
	var request_url = 'https://ma-goo.net/labo/url_exists/api.php?url=' + target_url;

    	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if( xhr.status === 200 || xhr.status === 301 || xhr.status === 304){
		    var ret = JSON.parse(xhr.responseText); // responseXML
		    switch(ret.http_code){
		   	 case 200:
			 case 301:
				 tmptxt = document.getElementById("result_list").value + target_url + String.fromCharCode(13);
				 document.getElementById("result_list").value = tmptxt;
				 break;
			 default:
				ret.url = target_url;
				console.log(ret);
				break;	 
		    }
            } else {
                response.error_code = xhr.status;
		response.error_message = xhr.statusText;
            }
        }
    };
    xhr.onload = function() {
        // TODO: hide a loader
    };

    xhr.open('GET', request_url , true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');            
    xhr.send("");



}

</script>
</body>
</html>

