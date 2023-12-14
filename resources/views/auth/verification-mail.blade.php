<p>Welcome {{ $user->fname }} {{ $user->lname }} </p>

<p>You received this email as a result of your registration to our website </p>
<p>Please click on the verification link to verify your account </p>

<p>
    <a href="{{url('/verification/' . $user->id . '/'.  $user->remember_token)}}">Click Here</a>
</p>
