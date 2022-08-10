import { userIdData, userId} from "./likeDislikeVideo.js";

const subBtn = document.querySelector('.subscribeBtn');

if (subBtn) {
	subBtn.addEventListener('click', () => {

		if (!userId) {
			Swal.fire('You must be signed in to perform this action', '', 'error');
      		return;
		}

		console.log('clocked');
	});
}