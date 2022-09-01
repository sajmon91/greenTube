export const userIdData = document.querySelector('.dropdown button');
export const userId = (userIdData) ? userIdData.dataset.userid : null;
const videoLikeBtn = document.querySelector('.videoLike');
const videoDislikeBtn = document.querySelector('.videoDislike');


if (videoLikeBtn) {
	videoLikeBtn.addEventListener('click', () => {

		if (!userId) {
			Swal.fire('You must be signed in to perform this action', '', 'error');
      		return;
		}

		videoLikeBtn.classList.add('active');
		videoDislikeBtn.classList.remove('active');

		const videoId = videoLikeBtn.dataset.videoid;
		const videoLikeText = videoLikeBtn.querySelector('.btnText');
		const videoDislikeText = videoDislikeBtn.querySelector('.btnText');
		const urlROOT = userIdData.dataset.urlroot;


		fetch('/greenTube/watch/like', {
			method: 'POST',
	        headers: {
	          "Content-Type": "application/json"
	        },
	        body: JSON.stringify(videoId)
		})
		.then(response => {
			if (!response.ok) {
	          throw new Error();
	        }
	        return response.json();
		})
		.then(data => {

			updateLikesValue(videoLikeText, data.likes);
			updateLikesValue(videoDislikeText, data.dislikes);

			if (data.likes < 0) {
				videoLikeBtn.classList.remove('active');
				videoLikeBtn.querySelector('img').src = `${urlROOT}/assets/images/icons/like.png`;
			}else{
				videoLikeBtn.querySelector('img').src = `${urlROOT}/assets/images/icons/like-active.png`;
			}

			videoDislikeBtn.querySelector('img').src = `${urlROOT}/assets/images/icons/dislike.png`;

		})
		.catch(err => console.error(err));

	});
}


export function updateLikesValue(element, num){
	const likesCountVal = element.textContent || 0;
	element.textContent = parseInt(likesCountVal) + parseInt(num);
};

if (videoDislikeBtn) {
	videoDislikeBtn.addEventListener('click', () => {

		if (!userId) {
			Swal.fire('You must be signed in to perform this action', '', 'error');
      		return;
		}

		videoLikeBtn.classList.remove('active');
		videoDislikeBtn.classList.add('active');

		const videoId = videoLikeBtn.dataset.videoid;
		const videoLikeText = videoLikeBtn.querySelector('.btnText');
		const videoDislikeText = videoDislikeBtn.querySelector('.btnText');
		const urlROOT = userIdData.dataset.urlroot;

		fetch('/greenTube/watch/dislike', {
			method: 'POST',
	        headers: {
	          "Content-Type": "application/json"
	        },
	        body: JSON.stringify(videoId)
		})
		.then(response => {
			if (!response.ok) {
	          throw new Error();
	        }
	        return response.json();
		})
		.then(data => {

			updateLikesValue(videoLikeText, data.likes);
			updateLikesValue(videoDislikeText, data.dislikes);

			if (data.dislikes < 0) {
				videoDislikeBtn.classList.remove('active');
				videoDislikeBtn.querySelector('img').src = `${urlROOT}/assets/images/icons/dislike.png`;
			}else{
				videoDislikeBtn.querySelector('img').src = `${urlROOT}/assets/images/icons/dislike-active.png`;
			}

			videoLikeBtn.querySelector('img').src = `${urlROOT}/assets/images/icons/like.png`;

		})
		.catch(err => console.error(err));
	});
}