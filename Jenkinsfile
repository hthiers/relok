pipeline {
  agent any
  stages {
    stage('Inicio') {
      agent any
      steps {
        sh 'echo Inicio'
        sh 'echo ${BRANCH_NAME}'
      }
    }

    stage('Build PHP') {
      agent {
        dockerfile {
          filename 'php.Dockerfile'
        }

      }
      steps {
        sh 'composer install'
      }
    }

    stage('Deploy Cert') {
      agent any
      when { branch 'certificacion' }
      steps {
        sshagent(credentials: ['andesnode']) {
          sh 'eval rsync -rl --del --exclude=.git --exclude rsync.log --log-file=rsync.log ./ andes@${SERVER}:${CER}'
        }

        echo 'Fin'
      }
    }

    stage('Deploy Prod') {
      agent any
      when { branch 'master' }
      steps {
        sshagent(credentials: ['andesnode']) {
          sh 'eval rsync -rl --del --exclude=.git --exclude rsync.log --log-file=rsync.log ./ andes@${SERVER}:${PRO}'
          echo 'a prod'
        }

        echo 'Fin'
      }
    }

  }
  environment {
    SERVER = 'andesnode.com'
    DEV = ''
    CER = '/home/andes/docker-relok/app/www/relok-cer'
    PRO = '/home/andes/docker-relok/app/www/relok'
  }
}