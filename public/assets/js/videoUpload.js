const uploadBtn = document.querySelector('.uploadVideoButton');

if (uploadBtn) {
  uploadBtn.addEventListener('click', (e) => {
    e.preventDefault();

    const uploadForm = document.querySelector('.videoUploadForm');

    const formData = new FormData(uploadForm);
    const formProps = Object.fromEntries(formData);

    // validate video 
    const allowedTypes = ['mp4', 'flv', 'webm', 'mkv', 'vob', 'ogv', 'ogg', 'avi', 'wmv', 'mov', 'mpeg', 'mpg'];
    const sizeLimit = 250 * 1024 * 1024;
    const videoType = formProps.fileInput.name.split('.');
    const ext = videoType[videoType.length - 1];

    if (!formProps.fileInput.size > 0) {
      Swal.fire('Please select file', '', 'error');
      return;
    }

    if (!allowedTypes.includes(ext)) {
      Swal.fire('Invalid file type', '', 'error');
      return;
    }

    if (formProps.fileInput.size > sizeLimit) {
      Swal.fire('The file must be less than 250MB', '', 'error');
      return;
    }

    //validate title
    if (formProps.videoTitle === '') {
      Swal.fire('Please enter title', '', 'error');
      return;
    }

    //loader
    Swal.fire({
      title: 'Uploading...',
      html: 'Please wait...',
      allowEscapeKey: false,
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading()
      }
    });

    // send data
    fetch('/greenTube/processing/', {
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
          Swal.fire(`${data.msg}`, '', 'success').then((result) => {
            uploadForm.reset();
          });
        }else{
          Swal.fire(`${data.msg}`, '', 'error');
        }
        
      })
      .catch(err => console.error(err));
  });
}