<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
</head>

<body>
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-header">
                crud ajax
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Search...">
                </div>

                <table class="table table-bordered mt-3">
                    <tr>
                        <th colspan="4">
                            List Of Product
                            <div wire:loading.delay.longest>
                                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal"
                                    data-bs-target="#postModal" id='createBtn'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </button>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Discription</th>
                        <th>Actions</th>
                    </tr>
                    <tbody id="posts-table">
                        @foreach ($posts as $post)
                            <tr id="post_{{ $post->id }}">
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->body }}</td>


                                <td>

                                    <button class="btn  btn-edit" data-id="{{ $post->id }}" type="button"
                                        ,data-bs-target="#EditModal
                                        class="btn
                                        btn-success float-end"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                        </svg></button>


                                    <button class="btn  btn-delete" data-id="{{ $post->id }}"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="postForm">

                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>

                        <input type="hidden" id="postId" name="postId">
                        <div class="mb-3">
                            <label for="titleID" class="form-label">Name:</label>
                            <input type="text" id="titleID" name="title" class="form-control" placeholder="Title"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="bodyID" class="form-label">Discription:</label>
                            <textarea name="body" class="form-control" id="bodyID" required></textarea>
                        </div>


                        <div class="mb-3 text-center">

                            <button type="submit" class="btn btn-success btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function(e) {
            e.preventDefault();
            let id = $("#postId").val();
            let title = $("#titleID").val();
            let body = $("#bodyID").val();
            let url = id ? "{{ url('posts') }}/" + id : "{{ route('posts.store') }}";
            console.log(url);
            let type = id ? 'PUT' : 'POST';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    title: title,
                    body: body
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        location.reload();
                        Swal.fire({
                            icon: "success",
                            title: "Your work has been saved",
                            timer: 1500
                        });

                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }


        $(document).on('click', '.btn-edit', function(e) {
            let postId = $(this).data('id');
            console.log(postId);
            e.preventDefault();

            $.ajax({

                url: "/posts/" + postId + '/edit',
                type: 'GET',

                success: function(response) {
                    console.log(response);
                    $('#postId').val(postId);
                    $('#bodyID').val(response.body);
                    $('#titleID').val(response.title);
                    $('#exampleModalLabel').text('Edit posts');
                    $('#submit').text('Update');
                    $('#postModal').modal("show");

                }
            })
        });



        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    $.ajax({
                        type: 'get',
                        url: "/posts/delete/" + id,
                        success: function(data) {
                            // alert(data.success);
                            swalWithBootstrapButtons.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            }).then((willSubmit) => {
                                if (!willSubmit) {
                                    return false;
                                }
                                location.reload();
                            });
                        }
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                    });
                }
            });


        });

        $(document).on('click', '#createBtn', function() {
            $('#exampleModalLabel').text('Create posts');
            $('#submit').text('Submit');
            $('#postForm').trigger('reset')
        })

        // $('#postForm').validate({ // initialize the plugin
        //     rules: {
        //         title: {
        //             required: true,
        //             email: true
        //         },
        //         body: {
        //             required: true,
        //             minlength: 5
        //         }
        //     }
        // });
    </script>

</body>

</html>
