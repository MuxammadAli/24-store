<table border="1">
    <tr>
        <td>
            ID:
        </td>
        <td>
            Image
        </td>
        <td>
            Title LLC
        </td>

        <td>
            Service name
        </td>

        <td>
            Has balance
        </td>
    </tr>

    @foreach($services as $service)
        <tr>
            <td>
                {{ $service['id'] }}
            </td>

            <td>
                <img  width="50" src="{{ $service['logoUrl'] }}">
            </td>

            <td>
                {{ $service['title'] }}
            </td>
            <td>
                {{ $service['titleShort'] }}
            </td>

            <td>
                @if(!empty($service['services'][0]))
                    @if(empty($service['services'][0]['childId']))
                        not Child
                    @endif

                    @if (count($service['services']) > 1)
                       | More
                    @endif


                @endif
            </td>

            <td>
                @if(!empty($service['services'][0]) && !empty($service['services'][0]['childId']))
                    @if($service['services'][0]['services'][0])
                        @foreach($service['services'][0]['services'][0]['fields'] as $field)
                            {{ $field['name'] }} <br>
                        @endforeach
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
</table>
