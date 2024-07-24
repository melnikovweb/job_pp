const concurrently = require('concurrently');
const glob = require('glob');
const path = require('path');
const minimist = require('minimist');

const argv = minimist(process.argv.slice(2));
const mode = argv.mode || 'development';
const isWatching = !!argv.watch;
const strictEntries = argv.entries ? argv.entries.split(',') : [];

console.log(`\x1b[36mModules:\x1b[0m \x1b[35m${strictEntries.join(', ') || 'All'}\x1b[0m`);
console.log(`\x1b[36mMode:\x1b[0m \x1b[35m${mode}\x1b[0m`);
console.log(`\x1b[36mWatch:\x1b[0m \x1b[35m${isWatching}\x1b[0m`);
console.log(`\n`);

function getEntries({ root, ext = 'php' }) {
  const pattern = `${root}/**/*.${ext}`;
  return glob
    .sync(pattern)
    .map((filePath) => {
      const { dir, name } = path.parse(filePath);

      if (path.basename(dir) !== name) return null;

      // eslint-disable-next-line n/no-path-concat
      return dir.replace(`${__dirname}${path.sep}`, '');
    })
    .filter(Boolean);
}

const entries = [
  ...getEntries({ root: 'blocks' }),
  ...getEntries({ root: 'templates' }),
  ...getEntries({ root: 'template-parts' }),
  ...getEntries({ root: 'src/core', ext: 'js' }),
];

const processedEntries = entries.filter((entry) => {
  const name = path.basename(entry);

  return !strictEntries.length || strictEntries.includes(name);
});

const commands = processedEntries.map((entry) => {
  const name = path.basename(entry);
  const unixEntryPath = path.normalize(entry).split(path.sep).join('/');

  return {
    command: `rimraf "./public/${name}/*" && npx webpack`,
    name,
    prefixColor: 'blue',
    env: {
      ENTRY: `${entry}`,
      UNIX_ENTRY_PATH: `${unixEntryPath}`,
      WATCH: `${isWatching}`,
      MODE: `${mode}`,
      MODULE_NAME: `${name}`,
    },
  };
});

const MAX_PROCESSES = 4;

const { result } = concurrently(commands, {
  prefix: '{name}: ',
  killOthers: ['failure'],
  maxProcesses: isWatching ? null : MAX_PROCESSES,
});

result
  .then(() => console.log('\x1b[32m%s\x1b[0m', '✓ All builds completed successfully!'))
  .catch(() => console.error('\x1b[31m%s\x1b[0m', '✗ Templates build failed'));
