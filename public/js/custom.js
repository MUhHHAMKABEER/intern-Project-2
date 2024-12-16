// $(document).ready(function() {
//     $(document).on('click', '.btn', function(e) {
//         e.preventDefault();

//         const form = $(this).closest('form');
//         const blogId = form.data('blog-id');
//         const icon = $(`#thumb-toggle-${blogId}`);
//         const likeCountElement = $(`#like-count-${blogId}`);

//         $.ajax({
//             url: `/blogs/${blogId}/like`,
//             method: 'POST',
//             data: {
//                 _token: '{{ csrf_token() }}',
//             },
//             success: function(response) {
//                 if (response.liked) {
//                     icon.removeClass('bi-hand-thumbs-up').addClass('bi-hand-thumbs-up-fill');
//                 } else {
//                     icon.removeClass('bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up');
//                 }
//                 likeCountElement.text(response.likes + ' ' + (response.likes === 1 ? 'like' : 'likes'));
//             },
//             error: function(xhr, status, error) {
//                 console.error('Error:', error);
//                 alert('Could not process the request. Try again.');
//             }
//         });
//     });
// });
