var api_url = '';

switch( process.env.NODE_ENV ){
    case 'development':
        api_url = 'http://kwambuilms.dev.ml/api';
        break;
    case 'production':
        api_url = 'https://kwambuilms.ml/';
        break;
}

export const LMS_CONFIG = {
    API_URL: api_url,
}