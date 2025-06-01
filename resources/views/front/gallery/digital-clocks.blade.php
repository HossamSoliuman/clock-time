@foreach ($images as $image)
    <div class="col-md-3 mb-4">
        <img src="{{ asset('images/gallery/digital-clocks/' . $image) }}" class="img-fluid rounded">
    </div>
@endforeach
