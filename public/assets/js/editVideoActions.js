const thumbnailItems = [...document.querySelectorAll('.thumbnailItem')];

if (thumbnailItems) {
	thumbnailItems.forEach( el => {
		el.addEventListener('click', () => {

			const videoId = el.dataset.videoid;
			const thumbId = el.dataset.thumbid;

			let formData = new FormData();
			formData.append('videoId', videoId);
			formData.append('thumbId', thumbId);

			fetch('/greenTube/editVideos/updateThumbnail', {
		        method: 'POST',
		        body: formData
		      })
		      .then(response => {
		        if (!response.ok) {
		          throw new Error();
		        }
		        return response.json();
		      })
		      .then(data => {

		      	if (data.status) {
		      		thumbnailItems.forEach(ele => {
						ele.classList.remove('selected');
					});

					el.classList.add('selected');

		      		Swal.fire(`${data.msg}`, '', 'success');
		      	}		      
		      })
		      .catch(err => console.error(err));
		});
		
	});
}
