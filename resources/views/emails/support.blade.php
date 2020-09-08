<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
</head>
<body>
Name : {!! $name !!}<br/>
Company : {!! $company !!}<br/>
E-mail : <a href="mail:{{$email}}">{{$email}}</a><br/>
Phone : <a href="tel:{{$tel}}"> {!! $tel !!} </a> <br/>
Subject : {!! $title !!}<br/>
Message : {!! $text !!} <br/>
</body>
</html>