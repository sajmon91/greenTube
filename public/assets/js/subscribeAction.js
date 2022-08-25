import { userIdData, userId} from "./likeDislikeVideo.js";

const subBtn = document.querySelector('.subscribeBtn');
const toggleCSSclasses = (el, ...cls) => cls.map(cl => el.classList.toggle(cl));

if (subBtn) {
	subBtn.addEventListener('click', () => {

		if (!userId) {
			Swal.fire('You must be signed in to perform this action', '', 'error');
      		return;
		}
		const subId = subBtn.dataset.subid;

		// change btn class and text
		toggleCSSclasses(subBtn, 'unsubscribe', 'subscribe');
		subBtn.textContent = subBtn.classList.contains('subscribe') ? 'subscribe' : 'subscribed';

		fetch('/greenTube/subscribers/subscribe', {
			method: 'POST',
	        headers: {
	          "Content-Type": "application/json"
	        },
	        body: JSON.stringify(subId)
		})
		.then(response => {
			if (!response.ok) {
	          throw new Error();
	        }
		})
		.catch(err => console.error(err));
		
	});
}