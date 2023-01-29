<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/reset.css">
  <link rel="icon" href="public/favicon1.ico">
  <title>COACHTECH</title>
  <style>
    body {
      font-size:16px;
      background-color:#2D197C;
    }

    .container {
      width:100%;
      height: 600px;
      display:flex;
      justify-content:center;
      align-items:center;
    }

    .todolist {
      width: 60%;
      margin-top:20%;
      position: absolute;
      padding:20px;
      background-color:#ffffff;
      border-radius: 20px;
    }

    .todolist_headder {
      width: 100%;
      height:auto;
      display: flex;
      justify-content: space-between;
    }

    .todolist_headder_title{
      font-size:30px;
      font-weight:bold;
    }
    .todolist_headder_item {
      display: flex;
      margin-right:20px;
      align-items:center;
      justify-content: flex-end;
    }

     .todolist_headder_item_logout_button {
      width:120px;
      height: 35px;
      margin-left:20px;
      background-color:#FFFFFF;
      border-color:#FF8080;
      color:#FF8080;
      border-radius:5px;
      cursor:pointer;
      border:2px solid;
      transition: all  0.3s ease;
    }

    .todolist_headder_item_logout_button:hover{
      width:120px;
      height: 35px;
      margin-left:20px;
      background-color:#FF8080;
      border-color:#FFFFFF;
      color:#FFFFFF;
      border-radius:5px;
    }

    .todolist_find_button{
      width:100px;
      height: 35px;
      margin: 0 0 1% 5%;
      background-color:#FFFFFF;
      border-color:#CDF119;
      color:#CDF119;
      border-radius:5px;
      border:2px solid;
      transition: all  0.3s ease;
    }

    .todolist_find_button:hover{
      width:100px;
      height: 35px;
      margin: 0 0 1% 5%;
      background-color:#CDF119;
      border-color:#FFFFFF;
      color:#FFFFFF;
      border-radius:5px;
      border:2px solid;
      transition: all  0.3s ease;
    }

    .todolist_warning {
      margin-left:5%;
    }

    .todolist_task-create-form{
      width: 65%;
      height: 30px;
      margin-left:5%;
      border-radius: 5px;
      border-color: #E6E6E6;
    }

    .todolist_table-select-tag {
      width:5%;
      height: 40px;
      margin: 0 5% 0 5%;
      border-radius: 5px;
      border-color: #E6E6E6;
      text-align:center;
    }
    
    .todolist_task-create-bottun {
      width:10%;
      height: 35px;
      background-color:#FFFFFF;
      border-color:#e181fb;
      color:#e181fb;
      border-radius:5px;
      transition: all  0.3s ease;
    }

    .todolist_task-create-bottun:hover {
      width:10%;
      height: 35px;
      background-color:#E181FB;
      border-color:#FFFFFF;
      color:#FFFFFF;
      border-radius:5px;
    }

    .todolist_table {
      margin-top:20px;
      width: 100%;
      text-align:center;
    }

    .todolist_table_edit_form {
      width:100%;
      height:25px;
      border-radius:5px;
      border-color: #E6E6E6;
    }

    .todolist_table-select-tag{
      height:30px;
      width:60px;
      border-radius:5px;
      border-color: #E6E6E6;
    }

    .todolist_table-edit-bottun{
      width:60px;
      height: 35px;
      background-color:#FFFFFF;
      border-color: #f99770;;
      color:#f99770;
      border-radius:5px;
    }

    .todolist_table-delete-bottun{
      width:60px;
      height: 35px;
      background-color:#FFFFFF;
      border-color:#88fbe0;
      color:#88fbe0;
      border-radius:5px;
    }
  </style>
</head>
<body>
  <div class="container">
      <div class="todolist">
        <div class="todolist_headder">
          <p class="todolist_headder_title">Todo List</p>
          <div class="todolist_headder_item">
            @if(Auth::check())
              <p>「{{ $user -> name }}」でログイン中</p>
            @endif
            <form action="/logout" method="post">
              @csrf
              <input type=submit class="todolist_headder_item_logout_button" value="ログアウト">
            </form>            
          </div>
        </div>
        <a href="/find" class="todolist_find">
          <button class="todolist_find_button">タスク検索</button>
        </a> 
        <form action="/create" class="todolist_task-create"  method="POST">
          @if (count($errors) > 0)
            <ul class="todolist_warning">
              @foreach ($errors->all() as $error)
                <li class="todolist_warning-title">{{$error}}</li>
              @endforeach
            </ul>
          @endif
          @csrf
            <input type="text" class="todolist_task-create-form"  name="name" >
            <select name="tag_id" class="todolist_table-select-tag">
              @foreach($tags as $tag)
               <option value="{{$tag->id}}">{{$tag->name}}</option>
              @endforeach
            </select>
            <button class="todolist_task-create-bottun">追加</button>
        </form>
        <table class="todolist_table">
          <tr>
            <th class="todolist_table-date">作成日</th>
            <th class="todolist_table-task">タスク名</th>
            <th class="todolist_table-task">タグ</th>
            <th class="todolist_table-create">更新</th>
            <th class="todolist_table-delete">削除</th>
          </tr>
            @foreach($todolists as $todolist)
              <tr>
                    <td>{{$todolist->created_at}}</td>
                  <form action="/edit" class="" method="POST">
                    @csrf
                    <td>
                      <input type="text" class="todolist_table_edit_form"  name="name" value="{{$todolist->name}}" >
                      <input type="hidden" name="id" value="{{$todolist->id}}"> 
                    </td>
                    <td>
                        <select name="tag_id" id="tag_id" class="todolist_table-select-tag" >
                          @foreach($tags as $tag)
                            @if(!empty($todolist->tag_id) && $todolist->tag_id == $tag->id) || old('tag_id') == $todolist->tag_id )
                              <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                            @else
                              <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endif
                          @endforeach
                        </select>
                    </td>
                    <td>
                      <button class="todolist_table-edit-bottun">更新</button>
                    </td>
                  </form>
                    <td>
                      <form action="/delete" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$todolist->id}}"> 
                        <button class="todolist_table-delete-bottun">削除</button>
                      </form>                    
                    </td>
              </tr>
            @endforeach  
        </table>
      </div>
  </div>
</body>
</html>