# 🛒 ALMOND - 쇼핑몰 웹 프로젝트 (PHP)

## < 프로젝트 한줄 소개 >
> **PHP + MySQL 기반 쇼핑몰 웹 서비스**로, 상품 조회/장바구니/주문/후기(게시판) 및 관리자 기능을 구현했습니다.

---
## 📌 목차
- [🧩 Tech Stack](#tech-stack)
- [✅ 핵심 기능 (요약)](#features)
- [🗺️ 시스템 구성도](#arch)
- [🎥 데모 영상 & 🖼️ 핵심 기능 스크린샷](#demo)
- [🗃️ DB 테이블 요약](#db)

---

<a id="tech-stack"></a>
## 🧩 Tech Stack
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **DB**: MySQL
- **Server/Etc**: (Apache/Apmsetup 등 네 환경에 맞게 작성), Session 기반 로그인/비회원 처리

---

<a id="features"></a>
## ✅ 핵심 기능 (요약)
### 사용자 기능
- 상품 목록/상세 조회
- 장바구니 담기 및 수량 변경
- 주문/결제 + 주문 완료/주문내역 조회
- 후기(게시판) 작성/조회 + 별점

### 관리자 기능
- 회원 목록 조회
- 주문 내역 조회
- 상품 등록/상품 리스트 관리

---

<a id="arch"></a>
## 🗺️ 시스템 구성도
> **Browser(HTML/CSS/JS)** → **PHP 서버(Apache)** → **MySQL**
- 사용자/관리자 권한에 따라 기능 분리
- 비회원도 구매 가능하도록 `session` 기반으로 장바구니/주문 데이터 관리

(원하면 여기 다이어그램 이미지로 만들어서 넣어줄게)

---

<a id="demo"></a>
## 🎥 데모 영상 & 🖼️ 핵심 기능 스크린샷

### 🎥 데모 영상
> (영상 있으면 링크/썸네일로 추가)
- Demo: (URL)

---

### 🖼️ 사용자 기능

**메인/이벤트 배너 | 상품 목록**
<p align="center">
  <img src="https://github.com/user-attachments/assets/453ce711-0a99-419d-9819-62dc269afe45" width="49%"/>
  <img src="https://github.com/user-attachments/assets/e5ef22a0-0838-4c95-a356-6db2c08a3f88" width="49%"/>
</p>

**상품 상세 | 후기 목록/상세**
<p align="center">
  <img src="https://github.com/user-attachments/assets/d8a0e8c1-be80-4ab3-b64e-84222aaa8e45" width="49%"/>
  <img src="https://github.com/user-attachments/assets/b6908ce6-dca9-4954-934c-3487bb3d3b69" width="49%"/>
</p>

**장바구니 | 주문/결제**
<p align="center">
  <img src="https://github.com/user-attachments/assets/70affbfa-0f80-4a07-b46a-4646c926c586" width="49%"/>
  <img src="https://github.com/user-attachments/assets/f677bfb7-3cd4-4dc1-8591-319511b0b548" width="49%"/>
</p>

**주문 완료 | 마이페이지/주문내역**
<p align="center">
  <img src="https://github.com/user-attachments/assets/31daddf7-8ffe-45f0-9daa-7883799180f2" width="49%"/>
  <img src="https://github.com/user-attachments/assets/1da83a59-bc20-46cb-aaca-b528a8dd1b62" width="49%"/>
</p>

---

### 🖼️ 관리자 기능

**주문 내역 조회 | 회원 목록 조회**
<p align="center">
  <img src="https://github.com/user-attachments/assets/0ddb17d7-5ad3-4b91-9d01-2d1b3d1a28b4" width="49%"/>
  <img src="https://github.com/user-attachments/assets/84e4230e-2492-451a-992f-272d54d9b3c9" width="49%"/>
</p>

**상품 등록 | 상품 리스트**
<p align="center">
  <img src="https://github.com/user-attachments/assets/880908b2-89eb-4f4b-9e66-8a9b5176b522" width="49%"/>
  <img src="https://github.com/user-attachments/assets/8d99b556-05ba-4ba6-92c4-23ce4a47aa4b" width="49%"/>
</p>

---

<a id="db"></a>
## 🗃️ DB 테이블 요약

### ✅ 전체 테이블
- `member`, `product`, `shoppingbag`, `orderlist`, `receivers`, `testboard`, `zipcode`

---

### 1) member (회원)
| Field | Type | Null | Key | Default | Extra |
|---|---|---:|---|---|---|
| uid | varchar(20) | YES |  | NULL |  |
| upass | varchar(20) | YES |  | NULL |  |
| uname | varchar(20) | YES |  | NULL |  |
| mphone | varchar(20) | YES |  | NULL |  |
| email | varchar(50) | YES |  | NULL |  |
| zipcode | varchar(7) | YES |  | NULL |  |
| addr1 | varchar(50) | YES |  | NULL |  |
| addr2 | varchar(50) | YES |  | NULL |  |
| approved | int(1) | YES |  | 1 |  |
| point | int(7) | YES |  | NULL |  |
| class | varchar(20) | YES |  | NULL |  |

---

### 2) product (상품)
| Field | Type | Null | Key | Default | Extra |
|---|---|---:|---|---|---|
| class | int(2) | YES |  | NULL |  |
| code | varchar(20) | NO | PRI | NULL |  |
| name | varchar(50) | YES |  | NULL |  |
| content | text | YES |  | NULL |  |
| price1 | int(7) | YES |  | NULL |  |
| price2 | int(7) | YES |  | NULL |  |
| userfile | varchar(50) | YES |  | NULL |  |
| hit | int(3) | YES |  | NULL |  |
| class2 | int(2) | YES |  | NULL |  |
| fileexplain | varchar(40) | YES |  | NULL |  |

---

### 3) shoppingbag (장바구니)
| Field | Type | Null | Key | Default | Extra |
|---|---|---:|---|---|---|
| id | varchar(20) | YES |  | NULL |  |
| session | tinytext | YES |  | NULL |  |
| pcode | varchar(20) | YES |  | NULL |  |
| quantity | int(3) | YES |  | NULL |  |

---

### 4) orderlist (주문 목록)
| Field | Type | Null | Key | Default | Extra |
|---|---|---:|---|---|---|
| id | varchar(20) | YES |  | NULL |  |
| session | tinytext | YES |  | NULL |  |
| pcode | varchar(20) | YES |  | NULL |  |
| quantity | int(3) | YES |  | NULL |  |
| ordernum | varchar(20) | YES |  | NULL |  |
| reviewstate | int(2) | YES |  | NULL |  |

---

### 5) receivers (배송 정보)
| Field | Type | Null | Key | Default | Extra |
|---|---|---:|---|---|---|
| id | varchar(20) | YES |  | NULL |  |
| session | tinytext | YES |  | NULL |  |
| receiver | varchar(20) | YES |  | NULL |  |
| phone | varchar(20) | YES |  | NULL |  |
| address | varchar(100) | YES |  | NULL |  |
| message | text | YES |  | NULL |  |
| buydate | varchar(30) | YES |  | NULL |  |
| sender | varchar(20) | YES |  | NULL |  |
| ordernum | varchar(20) | YES |  | NULL |  |
| status | int(1) | YES |  | NULL |  |

---

### 6) testboard (후기/게시판)
| Field | Type | Null | Key | Default | Extra |
|---|---|---:|---|---|---|
| id | int(4) | NO | PRI | NULL |  |
| writer | varchar(20) | YES |  | NULL |  |
| passwd | varchar(20) | YES |  | NULL |  |
| topic | varchar(20) | YES |  | NULL |  |
| content | varchar(100) | YES |  | NULL |  |
| hit | int(2) | YES |  | NULL |  |
| wdate | varchar(20) | YES |  | NULL |  |
| space | int(4) | YES |  | NULL |  |
| filename | varchar(40) | YES |  | NULL |  |
| code | varchar(20) | YES |  | NULL |  |
| star | int(2) | YES |  | NULL |  |
| ordernum | varchar(30) | YES |  | NULL |  |

---

### 7) zipcode (우편번호)
| Field | Type | Null | Key | Default | Extra |
|---|---|---:|---|---|---|
| zipcode | varchar(7) | YES |  | NULL |  |
| sido | varchar(15) | YES |  | NULL |  |
| gugun | varchar(20) | YES |  | NULL |  |
| dong | varchar(52) | YES |  | NULL |  |
| bunji | varchar(17) | YES |  | NULL |  |
| seq | int(5) | NO | PRI | 0 |  |

---

### 🔗 관계(요약)
- `product.code` ← `shoppingbag.pcode`, `orderlist.pcode`, `testboard.code`
- `orderlist.ordernum` ↔ `receivers.ordernum`
- 회원/비회원 공통 처리를 위해 `id` 또는 `session` 기반 저장 구조
