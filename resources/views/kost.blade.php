@extends('layouts.app')

@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <a href="/"><img style="height:40px;" src="https://mamikos.com/assets/logo/svg/logo_mamikos_green.svg"></a>
            <hr>
            <div class="col-12 text-right">
                <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-kost" onclick="addkost()">Add Kost</a>
            </div>
            <table id="laravel_crud" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kost as $item)
                    <tr>
                        <td>{{ $item->name  }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->location }}</td>
                        <td><a href="javascript:void(0)" data-id="{{ $item->id }}" onclick="editkost(event.target)" class="btn btn-info btn-sm">Edit</a></td>
                        <td><a href="javascript:void(0)" data-id="{{ $item->id }}" class="btn btn-danger btn-sm" onclick="deletekost(event.target)">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal" id="kost-modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Kost</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="userForm" class="form-horizontal">
                                <input type="hidden" name="kost_id" id="kost_id">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                        <span id="nameError" class="alert-message" style="color:red;"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="description" name="description" rows="2" cols="50"></textarea>
                                        <span id="descriptionError" class="alert-message" style="color:red;"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location">
                                        <span id="locationError" class="alert-message" style="color:red;"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="price" name="proce" placeholder="Enter Price">
                                        <span id="priceError" class="alert-message" style="color:red;"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="available_room" name="available_room" placeholder="Enter Room" type="number">
                                        <span id="roomError" class="alert-message" style="color:red;"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="image" name="image" placeholder="Enter Image URL" type="nuber">
                                        <span id="imageError" class="alert-message" style="color:red;"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="createkost()">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
<script>
    $('#laravel_crud').DataTable({
        searching: false,
        paging: false,
        info: false
    });

    function addkost() {
        $('#name').val('');
        $('#description').val('');
        $('#location').val('');
        $('#price').val('');
        $('#available_room').val('');
        $('#image').val('');
        $('#nameError').text('');
        $('#descriptionError').text('');
        $('#locationError').text('');
        $('#priceError').text('');
        $('#roomError').text('');
        $('#imageError').text('');
        $("#kost_id").val('');
        $('#kost-modal').modal('show');
    }

    function editkost(event) {
        var id = $(event).data("id");
        let url = '/kosts/' + id;
        $('#nameError').text('');
        $('#descriptionError').text('');
        $('#locationError').text('');
        $('#priceError').text('');
        $('#roomError').text('');
        $('#imageError').text('');

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                if (response) {
                    $("#kost_id").val(response.id);
                    $("#name").val(response.name);
                    $("#description").val(response.description);
                    $("#location").val(response.location);
                    $("#price").val(response.price);
                    $("#available_room").val(response.available_room);
                    $("#image").val(response.image);
                    $('#kost-modal').modal('show');
                }
            }
        });
    }

    function createkost() {
        var name = $('#name').val();
        var description = $('#description').val();
        var location = $('#location').val();
        var price = $('#price').val();
        var available_room = $('#available_room').val();
        var image = $('#image').val();
        var id = $('#kost_id').val();

        let url = '/kosts';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $('#nameError').text('');
        $('#descriptionError').text('');
        $('#locationError').text('');
        $('#priceError').text('');
        $('#roomError').text('');
        $('#imageError').text('');

        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: id,
                name: name,
                description: description,
                price: price,
                location: location,
                available_room: available_room,
                image: image,
                _token: _token
            },
            success: function(response) {
                if (response.code == 200) {
                    $('#name').val('');
                    $('#description').val('');
                    $('#location').val('');
                    $('#price').val('');
                    $('#available_room').val('');
                    $('#image').val('');

                    $('#kost-modal').modal('hide');

                    window.location.href = "{{ '/kosts' }}";
                }
            },
            error: function(response) {
                $('#nameError').text(response.responseJSON.errors.name);
                $('#descriptionError').text(response.responseJSON.errors.description);
                $('#locationError').text(response.responseJSON.errors.location);
                $('#priceError').text(response.responseJSON.errors.price);
                $('#roomError').text(response.responseJSON.errors.available_room);
                $('#imageError').text(response.responseJSON.errors.image);
            }
        });
    }

    function deletekost(event) {
        var id = $(event).data("id");
        let url = '/kosts/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: _token
            },
            success: function(response) {
                window.location.href = "{{ '/kosts' }}";
            }
        });
    }
</script>
@endpush