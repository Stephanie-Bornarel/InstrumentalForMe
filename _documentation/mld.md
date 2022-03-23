## MLD Instrumental For Me



- PROFILE: profile_code, certificate, presentation, avatar, is_teacher, #user_code->USER->user_code
:
has certificate: #certificate_code->CERTIFICATE->certificate_code, _#profile_code->PROFILE->profile_code
:
- CERTIFICATE: certificate_code, name
:
- INSTRUMENT: instrument_code, name, decsription, picture
:::


:
teach/learn: #type_code->MUSIC_STYLE->type_code, _#profile_code->PROFILE->profile_code
:::
- STUDENT: 
:::
- LESSON: lesson_code, appointment, status, email_student, student_message, teacher_message, #instrument_code->INSTRUMENT->instrument_code
:


:
- MUSIC_STYLE: type_code, name
:
- USER: user_code, email, password, firstname, lastname
::
- TEACHER: 
:::
