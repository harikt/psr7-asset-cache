## psr7-asset-cache

Cache all PSR-7 Assets.

## Why there is no clear command?

The clear command is the responsibility of the application. The library
could have a clear command, but doesn't know where the docroot is.

The docroot can be obtained from the cli, but if wrong root path is given,
it will delete all the directories recursively.

## Tests

Tests will followup.
