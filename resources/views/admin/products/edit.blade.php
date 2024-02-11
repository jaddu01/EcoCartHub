@extends('admin.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Update Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="productForm" name="productForm" method="POST" action="{{ route('admin.products.update', $product->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="productname">Product Name</label>
                                    <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" class="form-control" id="productname"
                                        placeholder="Enter Product Name">
                                    @error('product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="form-control" id="brand"
                                        placeholder="Brand">
                                    @error('brand')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" rows="4" class="form-control" id="description" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control" id="quantity"
                                        placeholder="Quantity">
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="productPrice">Product Price</label>
                                    <input type="text" name="product_price" value="{{ old('product_price', $product->product_price) }}" class="form-control" id="productPrice"
                                        placeholder="Product Price">
                                    @error('product_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="color">Product Color</label>
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Select Color</option>
                                        <option value="red">Red</option>
                                        <option value="blue">Blue</option>
                                        <option value="green">Green</option>
                                        <option value="yellow">Yellow</option>
                                    </select>
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        $(function() {
            $('#productForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    brand: {
                        required: true,
                        minlength: 5
                    },
                    description: {
                        required: true,
                        minlength: 5
                    },
                    quantity: {
                        required: true,
                        number: true
                    },
                    product_price: {
                        required: true,
                        number: true
                    },
                    color: {
                        required: true
                    }
                },
                messages: {
                    product_name: {
                        required: "Please enter product name",
                    },
                    brand: {
                        required: "Please enter brand name",
                        minlength: "Brand name should be at least 5 characters"
                    },
                    description: {
                        required: "Please enter description",
                        minlength: "Description should be at least 5 characters"
                    },
                    quantity: {
                        required: "Please enter quantity",
                        number: "Please enter valid quantity"
                    },
                    product_price: {
                        required: "Please enter product price",
                        number: "Please enter valid product price"
                    },
                    color: {
                        required: "Please select color"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
