import { userIdData } from "./likeDislikeVideo.js";

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

//////////////////////////////////////////////////////////////////////////////

// update user details info
const saveUserDetailsBtn = document.querySelector('.saveUserDetails');

if (saveUserDetailsBtn) {
	saveUserDetailsBtn.addEventListener('click', () => {
		const fn = document.querySelector('#fn').value;
		const ln = document.querySelector('#ln').value;
		const em = document.querySelector('#em').value;
		const un = document.querySelector('#un').value;

		let formData = new FormData();
		formData.append('firstName', fn);
		formData.append('lastName', ln);
		formData.append('email', em);
		formData.append('username', un);

		fetch('/greenTube/users/updateUserDetails', {
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
	      		let msgText = '';
	      		data.msg.forEach(el => {
	      			if (el !== null) {
	      				msgText += el + ' </br>';
	      			}
	      			
	      		});

	      		Swal.fire(`${msgText}`, '', 'error');
	      	}
	      })
	      .catch(err => console.error(err));
	});
}

//////////////////////////////////////////////////////////////////////////////

// update password
const savePasswordBtn = document.querySelector('.savePassword');

if (savePasswordBtn) {
	savePasswordBtn.addEventListener('click', () => {
		const oldPass = document.querySelector('#oldPass').value;
		const newPass = document.querySelector('#newPass').value;
		const conNewPass = document.querySelector('#conNewPass').value;

		let formData = new FormData();
		formData.append('oldPass', oldPass);
		formData.append('newPass', newPass);
		formData.append('conNewPass', conNewPass);

		fetch('/greenTube/users/updatePassword', {
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

//////////////////////////////////////////////////////////////////////////////

// update cover image
const saveCoverImgBtn = document.querySelector('.saveCoverImg');

if (saveCoverImgBtn) {
	const uplImg = document.querySelector('#coverImg');
	const img = document.querySelector('.imgCover');

	uplImg.addEventListener('change', () => {
		const [file] = uplImg.files;
		img.src = URL.createObjectURL(file);
	});

	saveCoverImgBtn.addEventListener('click', () => {
		const image = uplImg.files[0];

		if (image === undefined) {
			Swal.fire('You must take new picture', '', 'error');
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
      	formData.append('coverImage', image);

		fetch('/greenTube/users/updateCoverImg', {
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

//////////////////////////////////////////////////////////////////////////////

// update channel description
const saveChannelDescBtn = document.querySelector('.saveChannelDesc');

if (saveChannelDescBtn) {
	saveChannelDescBtn.addEventListener('click', () => {
		const channelDesc = document.querySelector('.channelDesc').value;

		let formData = new FormData();
		formData.append('channelDesc', channelDesc);

		fetch('/greenTube/users/updateChannelDesc', {
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