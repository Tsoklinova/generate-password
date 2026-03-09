# 🔐 PHP Password Generator

A lightweight, secure password generator built with pure PHP and modern web standards. Features cryptographically secure randomization, real-time length adjustment, and one-click clipboard copying—all without external dependencies.
Note: This is a single-file application for simplicity. No external CSS/JS files required.

![PHP Password Generator](Screenshot.png)

## ✨ Features

| Feature | Implementation |
|---------|---------------|
| **Cryptographically Secure** | Uses `random_int()` with hardware entropy (Linux: `/dev/urandom`) |
| **Length Control** | Adjustable slider (8-32 characters) |
| **Instant Copy** | Native Clipboard API—no Flash or libraries |
| **Session Persistence** | Maintains settings across page refreshes |
| **XSS Protected** | `htmlspecialchars()` sanitization |
| **Zero Dependencies** | Pure PHP + vanilla JavaScript |

## 🛡️ Security 🏗️ Architecture

┌─────────────────┐      ┌──────────────────┐     ┌─────────────────┐
│  User Request   │────▶│  PHP Session     │────▶│  random_int()   │
│  (POST/GET)     │      │ State Management │     │  CSPRNG (OS)    │
└─────────────────┘      └──────────────────┘     └─────────────────┘
         │                                               │
         ▼                                               ▼
┌─────────────────┐     ┌──────────────────┐      ┌─────────────────┐
│  HTML Output    │◀────│  htmlspecialchars│◀────│  Character Pool │
│  (Sanitized)    │     │  XSS Protection  │      │  A-Z,a-z,0-9,!@#│
└─────────────────┘     └──────────────────┘      └─────────────────┘

## 🔒 Security Features

| Threat                | Protection                          |
| --------------------- | ----------------------------------- |
| **XSS Attacks**       | `htmlspecialchars()` on all output  |
| **CSRF**              | Stateless form handling             |
| **Weak Randomness**   | `random_int()` instead of `rand()`  |
| **Session Hijacking** | Regenerates session on each request |
| **SQL Injection**     | No database interaction             |
