// update video thumbnail
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

///////////////////////////////////////////////////////////////////////////

// update video info
const saveVideoInfoBtn = document.querySelector('.saveVideoInfo');

if (saveVideoInfoBtn) {
	saveVideoInfoBtn.addEventListener('click', (e) => {
		e.preventDefault();

		const editForm = document.querySelector('.videoEditForm');

		const formData = new FormData(editForm);
    	const formProps = Object.fromEntries(formData);

		if (formProps.videoTitle === '') {
			Swal.fire('Please enter title', '', 'error');
      		return;
		}

		fetch('/greenTube/editVideos/updateVideoInfo', {
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
	          Swal.fire(`${data.msg}`, '', 'success');
	        }else{
	          Swal.fire(`${data.msg}`, '', 'error');
	        }
	        
	      })
	      .catch(err => console.error(err));
	});
}