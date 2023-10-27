module.exports = {
  parser: '@typescript-eslint/parser', // Specifies the ESLint parser
  extends: [
    'next/core-web-vitals',
    // 'plugin:@typescript-eslint/recommended', // Uses the recommended rules from the @typescript-eslint/eslint-plugin
    'prettier',
  ],
  plugins: ['sort-destructure-keys'],
  parserOptions: {
    ecmaVersion: 2020, // Allows for the parsing of modern ECMAScript features
    sourceType: 'module', // Allows for the use of imports
  },
  env: {
    es6: true,
    node: true,
  },
  rules: {
    'no-var': 'warn',
    semi: 'warn',
    'no-multi-spaces': 'warn',
    'space-in-parens': 'warn',
    'no-multiple-empty-lines': 'warn',
    'prefer-const': 'warn',
    'no-use-before-define': 'off',
    '@typescript-eslint/ban-ts-comment': 'off',
    '@typescript-eslint/no-explicit-any': 'off',
    '@typescript-eslint/explicit-module-boundary-types': 'off',
    '@typescript-eslint/ban-ts-ignore': 'off',
    '@typescript-eslint/explicit-function-return-type': 'off',
    'prefer-destructuring': ['warn'],
    'prefer-template': 'warn',
    'object-shorthand': 'warn',
    'newline-after-var': ['warn', 'always'],
  },
};
