import { userIdData, userId, updateLikesValue } from "./likeDislikeVideo.js";

const postCommentBtn = document.querySelector('.postComment');

const likesBtns = [...document.querySelectorAll('.commLikeBtn')];
const dislikesBtns = [...document.querySelectorAll('.commDislikeBtn')];
const replysBtns = [...document.querySelectorAll('.replyBtn')];
const getReplysBtns = [...document.querySelectorAll('.viewReplies')];

const urlROOT = (userIdData) ? userIdData.dataset.urlroot : '';

//////////////////////////////////////////////////////////////////////////////////////

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

//////////////////////////////////////////////////////////////////////////////////////

// like comment
if (likesBtns) {
	likeComment(likesBtns);
}

function likeComment(btns){
	btns.forEach(el => {
		el.addEventListener('click', () => {

			if (!userId) {
				Swal.fire('You must be signed in to perform this action', '', 'error');
	      		return;
			}

			const commId = el.dataset.commid;
			const dislikeBtn = el.nextElementSibling;
			const likeBtnText = el.querySelector('.btnText');
			const dislikeBtnText = dislikeBtn.querySelector('.btnText');
			

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

//////////////////////////////////////////////////////////////////////////

// dislike comment
if (dislikesBtns) {
	dislikeComment(dislikesBtns);
}

function dislikeComment(btns){
	btns.forEach(el => {
		el.addEventListener('click', () => {

			if (!userId) {
				Swal.fire('You must be signed in to perform this action', '', 'error');
	      		return;
			}

			const commId = el.dataset.commid;
			const likeBtn = el.previousElementSibling;
			const dislikeBtnText = el.querySelector('.btnText');
			const likeBtnText = likeBtn.querySelector('.btnText');

			fetch('/greenTube/comments/commentDislike', {
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

				if (data.dislikes < 0) {
					el.querySelector('img').src = `${urlROOT}/assets/images/icons/dislike.png`;
				}else{
					el.querySelector('img').src = `${urlROOT}/assets/images/icons/dislike-active.png`;
				}

				likeBtn.querySelector('img').src = `${urlROOT}/assets/images/icons/like.png`;

			})
			.catch(err => console.error(err));
		});
	});
}

//////////////////////////////////////////////////////////////////////////////////////

// post reply comment
if (replysBtns) {
	replysBtns.forEach(el => {
		el.addEventListener('click', () => {

			if (!userId) {
				Swal.fire('You must be signed in to perform this action', '', 'error');
	      		return;
			}
		
			const parent = el.closest('.comment');
			const replyForm = parent.querySelector('.replyForm');
			replyForm.classList.remove('hidden');

			const cancleBtn = replyForm.querySelector('.cancelBtn');
			const postReplyBtn = replyForm.querySelector('.postReplyComment');

			const userImg = document.querySelector('.userIcon').src;

			cancleBtn.addEventListener('click', () => {
				replyForm.classList.add('hidden');
			});

			postReplyBtn.addEventListener('click', () => {
				const formBody = replyForm.querySelector('.replyCommentBody');
				const commId = postReplyBtn.dataset.commid;
				const videoId = postReplyBtn.dataset.videoid;

				if (formBody === '') {
					Swal.fire("You can't post an empty comment", '', 'error');
			      	return;
				}

				const data = {
					'videoId' : videoId,
					'commId' : commId,
					'commBody' : formBody.value
				};

				formBody.value = '';

				fetch('/greenTube/comments/commentReply', {
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

						                  </div>
						                </div>
						              </div>`;

					parent.insertAdjacentHTML('beforeend', comHTML);
					replyForm.classList.add('hidden');

				})
				.catch(err => console.error(err));
			});
		});
	});
}

//////////////////////////////////////////////////////////////////////////////////////


// get all comment replies
if (getReplysBtns) {
	getReplysBtns.forEach(el => {
		el.addEventListener('click', () => {
			const commId = el.dataset.commid;
			const parent = el.closest('.comment');
			const url = el.dataset.urlroot;

			fetch('/greenTube/comments/getCommentReplies', {
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

					let html = '';

					data.forEach(ele => {
						html += `<div class="commentWrapper">
					                <a href="profile.html">
					                  <img class="profilePicture" src="${url + ele.com.profilePic}" alt="user image">
					                </a>
					                <div class="comment">
					                  <h3><a href="profile.html">${ele.com.username}</a> <span>${ele.date}</span></h3>
					                  <div class="postedCommentBody">${ele.com.body}</div>
					                  <div class="controls">
					                    <button data-commid="${ele.com.commentId}" class="likeBtn commLikeBtn" title="I like this">
					                      <img src="${ele.wasLiked ? `${url}/assets/images/icons/like-active.png` : `${url}/assets/images/icons/like.png`}" alt="like button">
					                      <span class="btnText">${ele.likes ? ele.likes : ''}</span>
					                    </button>

					                    <button data-commid="${ele.com.commentId}" class="dislikeBtn commDislikeBtn" title="I dislike this">
					                      <img src="${ele.wasDisliked ? `${url}/assets/images/icons/dislike-active.png` : `${url}/assets/images/icons/dislike.png`}" alt="dislike button">
					                      <span class="btnText">${ele.dislikes ? ele.dislikes : ''}</span>
					                    </button>

					                  </div>
					                </div>
					              </div>`;
					});

					let replies = document.createElement('div');
					replies.classList.add('repliesSection');
					replies.innerHTML = html;

					el.remove();
					parent.appendChild(replies);

					const likeBtn = [...parent.querySelectorAll('.repliesSection .commLikeBtn')];
					likeComment(likeBtn);

					const disBtn = [...document.querySelectorAll('.repliesSection .commDislikeBtn')];
					dislikeComment(disBtn);

				})
				.catch(err => console.error(err));
		});
	});
}