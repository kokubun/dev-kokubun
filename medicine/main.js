if ('serviceWorker' in navigator) {
	navigator.serviceWorker.register('/serviceWorker.js')
	.then(
		function (registration) {
			console.log("regist Log" );
			if (typeof registration.update == 'function') {
				registration.update();
			}
		}
	).catch(function (error) {
		console.log("Error Log: " + error);
	});
}