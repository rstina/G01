<script>   
/**************************************** *
 * Print JSON-object from database
**************************************** */

    fetch('/api/product', {
	method: 'GET'
}).then(function (response) {
	// The API call was successful!
	if (response.ok) {
		return response.json();
	} else {
		return Promise.reject(response);
	}
}).then(function (data) {
    // This is the JSON from our response
    var apiProduct = document.getElementById("api-docs");
    apiProduct.innerHTML = JSON.stringify(data);
	console.log(data);
}).catch(function (err) {
	// There was an error
	console.warn('Something went wrong.', err);
});
</script>
<div id="api-docs">

</div>