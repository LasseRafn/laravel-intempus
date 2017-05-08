# Changelog

All Notable changes to `laravel-intempus` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 2017-05-08

### Changed (in v2)
- `find()` will now return false instead of an empty model
- `first()` will now return false instead of an empty model

### Added (in v2)
- `update()` on model can update the model
- `create()` on builder can create models

## 2017-01-16

### Added
- Can now get WorkType from WorkReport
    - ````$workreport->workType();````