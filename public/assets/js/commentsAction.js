import { userIdData, userId, updateLikesValue } from "./likeDislikeVideo.js";

const postCommentBtn = document.querySelector('.postComment');

const likesButns = [...document.querySelectorAll('.commLikeBtn')];

// updateLikesValue(postCommentBtn , 1);

// post comment
if (postCommentBtn) {
	postCommentBtn.addEventListener('click', () => {

		const commBody = postCommentBtn.previousElementSibling;
		const videoId = postCommentBtn.dataset.videoid;
		const commentsSection = document.querySelector('.comments');

		if (!userId) {
			Swal.fire('You must be signed in to perform this action', '', 'error');
      		return;
		}

		if (commBody.value === '') {
			Swal.fire("You can't post an empty comment", '', 'error');
      		return;
		}

		const bodyText = commBody.value;
		commBody.value = '';

		const userImg = document.querySelector('.userIcon').src;
		const data = {
			'videoId' : videoId,
			'bodyText' : bodyText
		};

		fetch('/greenTube/comments/postComment', {
			method: 'POST',
	        headers: {
	          "Content-Type": "application/json"
	        },
	        body: JSON.stringify(data)
		})
		.then(response => {
			if (!response.ok) {
	          throw new Error();
	        }
	        return response.json();
		})
		.then(data => {

			const comHTML = `<div class="commentWrapper">
				                <a href="profile.html">
				                  <img class="profilePicture" src="${userImg}" alt="user image">
				                </a>
				                <div class="comment">
				                  <h3><a href="profile.html">${userIdData.title}</a> <span>${data.date}</span></h3>
				                  <div class="postedCommentBody">${data.body}</div>
				                  <div class="controls">
				                    <button class="likeBtn" title="I like this">
				                      <img src="${userIdData.dataset.urlroot}/assets/images/icons/like.png" alt="like button">
				                      <span class="btnText"></span>
				                    </button>

				                    <button class="dislikeBtn" title="I dislike this">
				                      <img src="${userIdData.dataset.urlroot}/assets/images/icons/dislike.png" alt="dislike button">
				                      <span class="btnText"></span>
				                    </button>

				                    <button class="replyBtn">
				                      <span class="btnText">Reply</span>
				                    </button>

				                  </div>
				                </div>
				              </div>`;

			commentsSection.insertAdjacentHTML('afterbegin', comHTML);
		})
		.catch(err => console.error(err));
		
	});
}

// like comment
if (likesButns) {
	likesButns.forEach(el => {
		el.addEventListener('click', () => {

			if (!userId) {
				Swal.fire('You must be signed in to perform this action', '', 'error');
	      		return;
			}

			const commId = el.dataset.commid;
			const dislikeBtn = el.nextElementSibling;
			const likeBtnText = el.querySelector('.btnText');
			const dislikeBtnText = dislikeBtn.querySelector('.btnText');
			const urlROOT = userIdData.dataset.urlroot;

			// console.log(commId, dislikeBtn, likeBtnText, dislikeBtnText, urlROOT);

			fetch('/greenTube/comments/commentLike', {
				method: 'POST',
		        headers: {
		          "Content-Type": "application/json"
		        },
		        body: JSON.stringify(commId)
			})
			.then(response => {
				if (!response.ok) {
		          throw new Error();
		        }
		        return response.json();
			})
			.then(data => {

				updateLikesValue(likeBtnText, data.likes);
				updateLikesValue(dislikeBtnText, data.dislikes);

				if (data.likes < 0) {
					el.querySelector('img').src = `${urlROOT}/assets/images/icons/like.png`;
				}else{
					el.querySelector('img').src = `${urlROOT}/assets/images/icons/like-active.png`;
				}

				dislikeBtn.querySelector('img').src = `${urlROOT}/assets/images/icons/dislike.png`;

			})
			.catch(err => console.error(err));
		});
	});
	
}
