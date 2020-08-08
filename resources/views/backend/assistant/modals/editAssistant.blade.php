<div id="editAssistant-{{ $assistant->_id }}" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="addAssistantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAssistantModalLabel">Edit Store Assistant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('assistants.update', $assistant->_id) }}" method="POST" id="submitForm">
                    @csrf
                    @method('PUT')

                    <div class="form-group row mb-2">
                        <label for="name" class="col-md-3 col-form-label my-label">Name:</label>
                        <br>
                        <div class="col-md-9">
                            <input name="name" type="text" class="form-control" id="name" placeholder="Enter name here"
                                value="{{  old('name', $assistant->name) }}">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="address" class="col-md-3 col-form-label my-label">Email:</label>
                        <br>
                        <div class="col-md-9">
                            <input name="email" type="email" class="form-control" id="email" required
                                placeholder="Enter Address" value="{{ old('email', $assistant->email) }}">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="inputphone" class="col-md-3 col-form-label my-label">Phone Number:</label>
                        <br>
                        <div class="col-md-9">
                            <input type="tel" id="phone" name="" class="form-control"
                                value="{{ old('phone_number',$assistant->phone_number) }}" required>
                            <input type="hidden" name="phone_number" id="phone_number" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="number" class="col-md-3 col-form-label my-label">Store:</label>
                        <br>
                        <div class="col-md-9">
                            <select name="store_id" id="store_id" class="form-control">
                                <option value=""> Select Store</option>
                                @foreach($stores as $store)
                                @if(is_array($store))
                                <option value="{{$store[0]->_id}}"
                                    {{$store[0]->_id == $assistant->store_id ? "selected":""}}>
                                    {{$store[0]->store_name}}</option>
                                @else
                                <option value="{{$store->_id}}" {{$store->_id ==$assistant->store_id ? "selected":""}}>
                                    {{$store->store_name}}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group my-4 text-right">
                        <button type="submit" class="btn btn-primary my-button">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
