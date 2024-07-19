@if ($user->isAdmin())
    @lang('Administrator')
@elseif ($user->isUser())
    @lang('User')
@elseif ($user->isLecturer())
    @lang('Lecturer')
@elseif ($user->isTechOfficer())
    @lang('Technical Officer')
@elseif ($user->isMaintainer())
    @lang('Maintainer')
@else
    @lang('N/A')
@endif
