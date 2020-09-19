#
# Build Frontend Assets
#
FROM node:8.11 as frontend

WORKDIR /app

COPY artisan package.json package-lock.json webpack.mix.js ./

RUN npm install

@foreach($config['build_resources'] as $resource)
COPY {{ $resource }} ./{{ $resource }}
@endforeach
COPY resources/js ./resources/js
COPY resources/sass ./resources/sass

RUN {{ $config['build_command'] }}
