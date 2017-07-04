pipeline {
    agent any
    stages {
        stage('install composer dependencies') {
            steps {
                sh 'composer install'
                sh 'composer update'
            }
        }

        stage('lint') {
            steps {
                sh '''
                    master_sha=$(git rev-parse origin/master)
                    newest_sha=$(git rev-parse head)
                    ./vendor/bin/phpcs \
                    --standard=silverorangetransitional \
                    --tab-width=4 \
                    --encoding=utf-8 \
                    --warning-severity=0 \
                    --extensions=php \
                    $(git diff --diff-filter=acrm --name-only $master_sha...$newest_sha)
                '''
            }
        }
    }
}
