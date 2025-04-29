<div>
   <h1>Display</h1>
   @foreach($images as $image)
   <img width="200" height="200" src="{{ asset('uploads/' . $image->path) }}" alt="Uploaded Image">
   @endforeach
</div>
