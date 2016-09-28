<div class="text-center">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">All messages</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name
                                    @if($orderBy === 'name' && $sort === 'ASC')
                                        <a href="{{ url('/?orderBy=name&sort=DESC') }}"><i class="fa fa-sort"></i></a>
                                    @else
                                        <a href="{{ url('/?orderBy=name&sort=ASC') }}"><i class="fa fa-sort"></i></a>
                                    @endif
                                </th>
                                <th>E-mail
                                    @if($orderBy === 'email' && $sort === 'ASC')
                                        <a href="{{ url('/?orderBy=email&sort=DESC') }}"><i class="fa fa-sort"></i></a>
                                    @else
                                        <a href="{{ url('/?orderBy=email&sort=ASC') }}"><i class="fa fa-sort"></i></a>
                                    @endif
                                </th>
                                <th>Homepage</th>
                                <th>IP</th>
                                <th>Browser Data</th>
                                <th>Message</th>
                                <th>File</th>
                                <th>Posted
                                    @if($orderBy === 'created_at' && $sort === 'ASC')
                                        <a href="{{ url('/?orderBy=created_at&sort=DESC') }}"><i class="fa fa-sort"></i></a>
                                    @else
                                        <a href="{{ url('/?orderBy=created_at&sort=ASC') }}"><i class="fa fa-sort"></i></a>
                                    @endif
                                </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr class="block">
                                        <td>{{ $message->id }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->homepage }}</td>
                                        <td>{{ $message->ip }}</td>
                                        <td>{{ $message->browser_name }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td>
                                            @if(isset($message->path))
                                                <a href="{{ $message->path }}" target="_blank">File</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $message->created_at }}</td>
                                        <td>
                                            <a href="{{ url('/delete/'.$message->id) }}">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    {{ $messages->links() }}
    <hr>
    <a href="{{ url('/add') }}" class="btn btn-default">
        <i class="fa fa-plus"></i> Add message
    </a>
</div>
