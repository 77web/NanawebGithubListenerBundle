# NanawebGithubListenerBundle

## How to install

```
composer require nanaweb/github-listener-bundle:"~0.9"
```

Then, add `Nanaweb\GithubListenerBundle\NanawebGithubListenerBundle` to your registered bundle list in AppKernel.
No configuration needed.


## How to use

Create your own `OperationRunner` class for [github webhook events](https://developer.github.com/webhooks/#events) .
OperationRunners must implement `Nanaweb\GithubListenerBundle\OperationRunner\OperationRunnerInterface` .


Register to Symfony DI Container with `nanaweb_github_listener.operation_runner` tag with `event` attribute like this:
```
services:
    fake_operation_runner:
        class: App\GithubListener\OperationRunner\MyOperationRunner
        tags:
            - { name: nanaweb_github_listener.operation_runner, event: pull_request }
```
