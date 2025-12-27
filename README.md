# 🛒 ALMOND - 쇼핑몰 웹 프로젝트 (PHP)

<a id="toc"></a>

## 목차
- [1) 프로젝트 한줄 소개](#intro)
- [2) 핵심 기능 스크린샷](#screens)
- [3) DB 테이블 요약](#db)

---

<a id="intro"></a>

## 1) 프로젝트 한줄 소개
> **PHP + MySQL 기반 쇼핑몰 웹 서비스**로, 상품 조회/장바구니/주문/후기(게시판) 및 관리자 기능을 구현했습니다.

---

<a id="screens"></a>

## 2) 핵심 기능 스크린샷

> ✅ **이미지가 옆으로 안 가고 밑으로 내려가는 문제 해결**
- Markdown 표(`|---|---|`)는 이미지가 크면 깨질 때가 많아서  
  **아래처럼 HTML `<table>`로 넣는 게 제일 안정적**입니다.

### ✅ 사용자 기능
<table>
  <tr>
    <th width="50%">메인/이벤트 배너</th>
    <th width="50%">상품 목록</th>
  </tr>
  <tr>
    <td><img src="docs/screenshots/<img width="2521" height="1317" alt="스크린샷 2025-12-27 205442" src="https://github.com/user-attachments/assets/453ce711-0a99-419d-9819-62dc269afe45" />
main.png" width="430"/></td>
    <td><img src="docs/screenshots/product_list.png" width="430"/></td>
  </tr>

  <tr>
    <th>상품 상세</th>
    <th>후기 목록/상세</th>
  </tr>
  <tr>
    <td><img src="docs/screenshots/product_detail.png" width="430"/></td>
    <td><img src="docs/screenshots/review_list.png" width="430"/></td>
  </tr>

  <tr>
    <th>장바구니</th>
    <th>주문/결제</th>
  </tr>
  <tr>
    <td><img src="docs/screenshots/cart.png" width="430"/></td>
    <td><img src="docs/screenshots/order.png" width="430"/></td>
  </tr>

  <tr>
    <th>주문 완료</th>
    <th>마이페이지/주문내역</th>
  </tr>
  <tr>
    <td><img src="docs/screenshots/order_done.png" width="430"/></td>
    <td><img src="docs/screenshots/mypage.png" width="430"/></td>
  </tr>
</table>

### ✅ 관리자 기능
<table>
  <tr>
    <th width="50%">주문 내역 조회</th>
    <th width="50%">회원 목록 조회</th>
  </tr>
  <tr>
    <td><img src="docs/screenshots/admin_orders.png" width="430"/></td>
    <td><img src="docs/screenshots/admin_members.png" width="430"/></td>
  </tr>

  <tr>
    <th>상품 등록</th>
    <th>상품 관리/리스트</th>
  </tr>
  <tr>
    <td><img src="docs/screenshots/admin_add_product.png" width="430"/></td>
    <td><img src="docs/screenshots/admin_products.png" width="430"/></td>
  </tr>
</table>

> 📌 스크린샷 넣는 법(추천)
- 레포에 `docs/screenshots/` 폴더 만들고 이미지 파일을 넣은 뒤 위 경로만 맞춰주면 됩니다.

---

<a id="db"></a>

## 3) DB 테이블 요약

### ✅ 전체 테이블
- `member`, `product`, `shoppingbag`, `orderlist`, `receivers`, `testboard`, `zipcode`

---

### 3-1) member (회원)
| Field | Type | Null | Key | Default | Extra | 설명 |
|---|---|---:|---|---|---|---|
| uid | varchar(20) | YES |  | NULL |  | 사용자 ID *(PK로 두는 게 일반적)* |
| upass | varchar(20) | YES |  | NULL |  | 비밀번호 |
| uname | varchar(20) | YES |  | NULL |  | 이름 |
| mphone | varchar(20) | YES |  | NULL |  | 전화번호 |
| email | varchar(50) | YES |  | NULL |  | 이메일 |
| zipcode | varchar(7) | YES |  | NULL |  | 우편번호 |
| addr1 | varchar(50) | YES |  | NULL |  | 주소1 |
| addr2 | varchar(50) | YES |  | NULL |  | 주소2 |
| approved | int(1) | YES |  | 1 |  | 승인/상태 |
| point | int(7) | YES |  | NULL |  | 포인트 |
| class | varchar(20) | YES |  | NULL |  | 회원 등급 |

---

### 3-2) product (상품)
| Field | Type | Null | Key | Default | Extra | 설명 |
|---|---|---:|---|---|---|---|
| class | int(2) | YES |  | NULL |  | 카테고리 분류 |
| code | varchar(20) | NO | PRI | NULL |  | 상품 코드(PK) |
| name | varchar(50) | YES |  | NULL |  | 상품명 |
| content | text | YES |  | NULL |  | 상세 설명 |
| price1 | int(7) | YES |  | NULL |  | 원가/정가 |
| price2 | int(7) | YES |  | NULL |  | 판매가 |
| userfile | varchar(50) | YES |  | NULL |  | 이미지 파일명 |
| hit | int(3) | YES |  | NULL |  | 조회수 |
| class2 | int(2) | YES |  | NULL |  | 서브 분류 |
| fileexplain | varchar(40) | YES |  | NULL |  | 파일 설명 |

---

### 3-3) shoppingbag (장바구니)
| Field | Type | Null | Key | Default | Extra | 설명 |
|---|---|---:|---|---|---|---|
| id | varchar(20) | YES |  | NULL |  | 회원 ID |
| session | tinytext | YES |  | NULL |  | 세션 식별(비회원용) |
| pcode | varchar(20) | YES |  | NULL |  | 상품 코드(product.code) |
| quantity | int(3) | YES |  | NULL |  | 수량 |

---

### 3-4) orderlist (주문 목록)
| Field | Type | Null | Key | Default | Extra | 설명 |
|---|---|---:|---|---|---|---|
| id | varchar(20) | YES |  | NULL |  | 회원 ID |
| session | tinytext | YES |  | NULL |  | 세션 식별 |
| pcode | varchar(20) | YES |  | NULL |  | 상품 코드(product.code) |
| quantity | int(3) | YES |  | NULL |  | 수량 |
| ordernum | varchar(20) | YES |  | NULL |  | 주문번호 |
| reviewstate | int(2) | YES |  | NULL |  | 리뷰 작성 상태 |

---

### 3-5) receivers (수령/배송 정보)
| Field | Type | Null | Key | Default | Extra | 설명 |
|---|---|---:|---|---|---|---|
| id | varchar(20) | YES |  | NULL |  | 회원 ID |
| session | tinytext | YES |  | NULL |  | 세션 식별 |
| receiver | varchar(20) | YES |  | NULL |  | 수령인 |
| phone | varchar(20) | YES |  | NULL |  | 연락처 |
| address | varchar(100) | YES |  | NULL |  | 주소 |
| message | text | YES |  | NULL |  | 배송메시지 |
| buydate | varchar(30) | YES |  | NULL |  | 구매일 |
| sender | varchar(20) | YES |  | NULL |  | 발신인 |
| ordernum | varchar(20) | YES |  | NULL |  | 주문번호(orderlist.ordernum) |
| status | int(1) | YES |  | NULL |  | 배송 상태 |

---

### 3-6) testboard (후기/게시판)
| Field | Type | Null | Key | Default | Extra | 설명 |
|---|---|---:|---|---|---|---|
| id | int(4) | NO | PRI | NULL |  | 글 ID(PK) |
| writer | varchar(20) | YES |  | NULL |  | 작성자 |
| passwd | varchar(20) | YES |  | NULL |  | 비밀번호 |
| topic | varchar(20) | YES |  | NULL |  | 제목 |
| content | varchar(100) | YES |  | NULL |  | 내용 |
| hit | int(2) | YES |  | NULL |  | 조회수 |
| wdate | varchar(20) | YES |  | NULL |  | 작성일 |
| space | int(4) | YES |  | NULL |  | 분류/공간 |
| filename | varchar(40) | YES |  | NULL |  | 첨부파일 |
| code | varchar(20) | YES |  | NULL |  | 상품 코드(product.code) |
| star | int(2) | YES |  | NULL |  | 별점 |
| ordernum | varchar(30) | YES |  | NULL |  | 주문번호 |

---

### 3-7) zipcode (우편번호)
| Field | Type | Null | Key | Default | Extra | 설명 |
|---|---|---:|---|---|---|---|
| zipcode | varchar(7) | YES |  | NULL |  | 우편번호 |
| sido | varchar(15) | YES |  | NULL |  | 시/도 |
| gugun | varchar(20) | YES |  | NULL |  | 구/군 |
| dong | varchar(52) | YES |  | NULL |  | 동 |
| bunji | varchar(17) | YES |  | NULL |  | 번지 |
| seq | int(5) | NO | PRI | 0 |  | 일련번호(PK) |

---

### 🔗 관계(요약)
- `product.code` ← `shoppingbag.pcode`, `orderlist.pcode`, `testboard.code`
- `orderlist.ordernum` ↔ `receivers.ordernum` *(주문 단위로 배송정보 연결)*
- 회원/비회원 공통 처리를 위해 `id` 또는 `session` 기반으로 데이터가 저장되는 구조
