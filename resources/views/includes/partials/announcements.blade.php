@if($announcements->count())
    @foreach($announcements as $announcement)
        <x-utils.alert :type="$announcement->type" :dismissable="false" class="px-4 py-2 mb-0">
            {{ (new \Illuminate\Support\HtmlString($announcement->message)) }}
        </x-utils.alert>
    @endforeach
@endif
