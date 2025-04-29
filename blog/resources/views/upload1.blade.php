<div>
    <h1>Upload File</h1>

    <form action="upload1" method="post" enctype="multipart/form-data">

    @csrf

    <input type="file" name="file">

    <br>
    <br>

    <button>Upload</button>

</form>
</div>
