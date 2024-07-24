# SECRET WP Theme

## Required dependencies
- Install [node](https://nodejs.org/en) >= 18.16.1 or above if you need
- Install npm >= 9.5.1 or above if you need

## Theme installation
- Download wordpress files form [official site](https://wordpress.org/download/) or install it with [Local](https://localwp.com/)
- Move to ```path_to_app/wp-content/themes``` folder
- Run in **themes** folder:
  - ```git clone git@SECRET.SECRET.dev:SECRET/wp-landing.git SECRET``` for ssh
  - ```git clone https://SECRET.SECRET.dev/SECRET/wp-landing.git SECRET``` for https
- Run ```npm install```
- Be sure you migrated database and plugins from prod using **wp-migrate** plugin

- **Enjoy** 

## Development
### Building the Project
#### Production Build
To create a production build of the project, use the following command:
```sh
# For building the entire project
npm run build:prod

# For building specific modules only
npm run build:dprodev -- --entries=module_name,second_module_name
```

#### Development Build
To create a development build of the project, use the following command:
```sh
# For building the entire project
npm run build:dev

# For building specific modules only
npm run build:dev -- --entries=module_name,second_module_name
```

#### Watch Mode
To continuously watch for changes in the source files and automatically rebuild the project, use the following command:
```sh
# For watching the entire project
npm run build:watch

# For watching specific modules only
npm run build:watch -- --entries=module_name,second_module_name
```


## Release Steps
### Release Process
1. Checkout to a release branch
2. Run commands:
_Replace_ `[version]` _with_ `major`, `minor` _or_ `patch`.
```sh
npm run release -- [version]
```
3. Go to the repository, release Pull Request will created automattically
4. Ensure all **pipelines pass successfully**.
5. [Deploy](#production-deployment) the release branch to production and test the production environment.
6. Once testing is complete, merge the release PR to the `main` branch.
7. [Deploy](#production-deployment) the `main` branch to production.
8. Ensure all **pipelines pass successfully**.
9. Go to the repository and merge the backmerge PR into the development branch.
10. **Create a release** in the repository using the latest tag and describe all the changes

By following these steps, you can ensure a smooth and organized release process for your project.

## Deployment
### Staging Deployment
[Deploy to Staging](https://jenkins.ops.SECRET.dev/job/stage/job/SECRET/job/landing)

### Production Deployment
[Deploy to Production](https://jenkins.ops.SECRET.dev/job/prod/job/SECRET/job/landing)