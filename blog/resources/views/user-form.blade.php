<div>
    <!-- An unexamined life is not worth living. - Socrates -->
     <h1>User Form</h1>

     <!-- @if($errors->any())

     @foreach($errors->all() as $error)

     <div>
        {{ $error }}
     </div>

     @endforeach
     @endif -->

     <form action="/add-user" method="post">

     @csrf

     <div class="input-wrapper">

     <input type="text" placeholder="Enter User Name" name="username" value="{{ old('username') }}">

     <span style="color:red">@error('username'){{ $message }}@enderror</span>

     </div>

    <div class="input-wrapper">

     <input type="text" placeholder="Enter User Email" name="email" value="{{ old('email') }}" class="{{ $errors->first('email')? 'is-invalid' : '' }}">

     <span style="color:red">@error('email'){{ $message }}@enderror</span>

     </div>

     <div class="input-wrapper">

     <input type="text" placeholder="Enter User City" name="city" value="{{ old('city') }}">

     <span style="color:red">@error('city'){{ $message }}@enderror</span>

     </div>

     <div class="input-wrapperr">

     <h5>Skills</h5>
     <input type="checkbox" name="skills[]" value="php" id="php">
     <label for="php">PHP</label>
     <input type="checkbox" name="skills[]" value="java" id="java">
     <label for="java">JAVA</label>
     <input type="checkbox" name="skills[]" value="node" id="node">
     <label for="node">Node</label>

     <br>
     <br>

     <span style="color:red">@error('skills'){{ $message }}@enderror</span>

     </div>

     <div class="input-wrapper">

     <button>Add New User</button>

     </div>

     </form>
</div>

<style>

.input-wrapper input{
    border:orange 1px solid;
    height:35px;
    width:200px;
    border-radius:2px;
    color:orange;
}

.input-wrapper{
    margin:10px;
}

button{
    border:orange 1px solid;
    height:35px;
    width:200px;
    border-radius:2px;
    color:orange;
    background-color:#fff;
    cursor:pointer;

}



</style>
