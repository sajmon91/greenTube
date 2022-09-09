import { userIdData, userId} from "./likeDislikeVideo.js";

// update profile image
const saveProfileImageBtn = document.querySelector('.saveProfileImg');

if (saveProfileImageBtn) {
	const uplImg = document.querySelector('#profileImg');
	const img = document.querySelector('.imgPro');

	uplImg.addEventListener('change', () => {
		const [file] = uplImg.files;
		img.src = URL.createObjectURL(file);
	});

	saveProfileImageBtn.addEventListener('click', () => {
		const image = uplImg.files[0];

		if (image === undefined) {
			Swal.fire('You must take picture', '', 'error');
      		return;
		}

		if (image.size > 2 * 1024 * 1024) {
			Swal.fire('File must be less than 2 MB', '', 'error');
      		return;
		}

		if (!['image/jpeg', 'image/png'].includes(image.type)) {
			Swal.fire('Only .jpg and .png image are allowed', '', 'error');
      		return;
		}

		let formData = new FormData();
      	formData.append('image', image);

		fetch('/greenTube/users/updateProfilePic', {
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
	      		document.querySelector('.userIcon').src = userIdData.dataset.urlroot + data.image;
	      	}else{
	      		Swal.fire(`${data.msg}`, '', 'error');
	      	}
	      })
	      .catch(err => console.error(err));
	});
}
