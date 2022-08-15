@extends('mails.master')
@section('content')
    <h4 style="font-family: Nunito">Dear {{$parent->fullname}}!</h4>
    <p>Class: {{$group->name}} - Teacher:{{$teacher->fullname}}</p>
    <div style="padding: 40px 0 20px">
        <table border="0" cellpadding="0" cellspacing="0" width="100%"
               style="border-collapse: collapse;">
            <tr>
                <td style="color: #6921a8; font-family: Arial, sans-serif;">
                    <h2 style="font-size: 20px; font-weight: 400; margin-top: 50px;">Academic progress</h2>
                    <table border="0" cellpadding="0" cellspacing="0"
                           style="border-collapse: collapse;" width="100%">
                        @foreach($datas as $item)
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['description']}}</td>
                                <td>{{$item['date']}}</td>
                                <td>{{$item['maximum_score']}}</td>
                                <td>{{$item['weight']}}</td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
        </table>
    </div>
@endsection
