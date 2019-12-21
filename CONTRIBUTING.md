# Contributing to Phalcon Developer Tools

Phalcon Developer Tools is an open source project and a volunteer effort.
Phalcon Developer Tools welcomes contribution from everyone.

## Contributions

Contributions to Phalcon Developer Tools should be made in the form of [GitHub pull requests][pr].
Each pull request will be reviewed by a core contributor (someone with permission to land patches) and either landed in
the main tree or given feedback for changes that would be required before it can be merged. All contributions should
follow this format, even those from core contributors.

## Questions & Support

*We only accept bug reports, new feature requests and pull requests in GitHub*.
For questions regarding the usage of the Phalcon Developer Tools or support requests please visit the
[official forums][forum]. IDE stubs must not be modified manually, if you want to improve them please submit a PR
to [Phalcon Framework][cphalcon].

## Bug Report Checklist

- Make sure you are using the latest released version of Phalcon Framework and Phalcon Developer Tools
  before submitting a bug report. Bugs in versions older than the latest released one will not be addressed by the
  core team

- If you have found a bug it is important to add relevant reproducibility information to your issue to allow us 
  to reproduce the bug and fix it quicker. Add a script, small program or repository providing the necessary code to 
  make everyone reproduce the issue reported easily. If a bug cannot be reproduced by the development it would be
  difficult provide corrections and solutions. [Submit Reproducible Test][srt] for more information.

- Be sure that information such as OS, Phalcon Framework and Phalcon Developer Tools versions and PHP version are
  part of the bug report

- If you're submitting a Segmentation Fault error, we would require a backtrace, please see [Generating a Backtrace][gb]

## Pull Request Checklist

- Don't submit your pull requests to the `master` branch. Branch from the required branch and,
  if needed, rebase to the proper branch before submitting your pull request.
  If it doesn't merge cleanly with master you may be asked to rebase your changes
  
- Don't put submodule updates, composer.lock, etc in your pull request unless they are to landed commits

- Make sure that the code you write fits with the general style and coding standards of the [Accepted PHP Standards][psr]

## Getting Support

If you have a question about how to use Phalcon, please see the [support page][support].

## Requesting Features

If you have a change or new feature in mind, please fill an [NFR][nfr].

Thanks! <br />
Phalcon Team


[pr]: https://help.github.com/articles/about-pull-requests/
[forum]: https://forum.phalcon.io/
[cphalcon]: https://github.com/phalcon/cphalcon
[srt]: https://docs.phalcon.io/en/latest/reproducible-tests
[gb]: https://docs.phalcon.io/en/latest/generating-backtrace
[support]: https://phalcon.io/en/support/
[nfr]: https://docs.phalcon.io/en/latest/new-feature-request
[psr]: https://www.php-fig.org/psr/
