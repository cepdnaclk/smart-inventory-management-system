@if ($user->isAdmin())
    @lang('Administrator')
@elseif ($user->isUser())
    @lang('User')
@elseif ($user->isLecturer())
    @lang('Lecturer')
@else
    @lang('N/A')
@endif
