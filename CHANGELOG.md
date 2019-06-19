# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.3.1] - 19th June 2019

### Changed

- Add constants for the Transfer (terminal) statuses

## [1.3.0] - 19th June 2019

### Added

- Implement the given Wallet Statement endpoint

## [1.2.1] - 6th June 2019

### Changed

- Remove temporarily the `soft` flag for KYC until FinBlocks re-enable

## [1.2.0] - 5th June 2019

### Added

- Added a new Country Code validator

### Changed

- Improved and descriptive error messages

## [1.1.1] - 29th May 2019

### Changed

- Apply fixes from StyleCI #5

## [1.1.0] - 28th May 2019

### Added

- Add `soft` flag for KYC, set to `false` by default

### Fixed

- Provide required `Hook Factory` arguments to create a `Callback` model from a JSON payload

### Changed

- Skip PHP Unit Tests for features that FinBlocks has reported as not yet implemented for the Crowd2Fund project; they are not a blocker at all, they just return the unexpected HTTP Status Code and JSON payload based on Crowd2Fund's requirements


## [1.0.0] - 22nd May 2019

### Added

First official and stable release for FinBlocks PHP SDK:
- Built-in HTTP Client that sends signed HTTP requests
- Built-in factory for all FinBlocks API models, aligned with the FinBlocks API docs
- Built-in API integration to perform HTTP calls to the API endpoints
  - Account Holders
  - Bank Accounts
  - Cards
  - Deposits
  - Direct Debit Flows & Mandates
  - Documents & KYC
  - Wallet to Wallet Transfers
  - Wallets
  - Withdrawal Requests
