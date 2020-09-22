<h1 align="center">	
디스이즈 - 동아대학교 스마트 캠퍼스 어플리케이션</h1>

<p align="center"><img src="https://user-images.githubusercontent.com/45222982/93844186-4a1ffd00-fcd7-11ea-8c83-46bb66d1f8ab.png" width="240" /></p>

<p align="center">스마트한 동아인의 필수 App은 무엇? 바로 이것(This is)!</p>

<p align="center"><a href="https://play.google.com/store/apps/details?id=kr.co.thisis.dsisproject&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1"><img src="https://user-images.githubusercontent.com/45222982/93845190-e26bb100-fcda-11ea-9dd3-737ffb68223a.png" width="240" /></a><a href="https://apps.apple.com/kr/app/%EB%94%94%EC%8A%A4%EC%9D%B4%EC%A6%88/id1490702439?mt=8"><img src="https://user-images.githubusercontent.com/45222982/93845192-e39cde00-fcda-11ea-8d05-cf1e50243b3c.png" width="240" /></a></p>

## 프로젝트 참가 이력
- Thisis Backend
  - WeShow
  - 학식정보
  - 전화번호부
  - 학사일정
 

## Tech
 - PHP
 - MYSQL
 - JSON
 - simpledom
 - crawling
 - BackTraking Algorithm
 - cron scheduler


## WeShow
  시간표 경우의 수 자동생성 프로그램

### Screen Shots
<p align="center"><img src="https://user-images.githubusercontent.com/45222982/93857691-f40e8200-fcf5-11ea-9e4f-f13ddaca4285.png" width="280" height="500"/> <img src="https://user-images.githubusercontent.com/45222982/93857700-f670dc00-fcf5-11ea-9a30-a4d41e9f9fe6.png" width="280" height="500"/></p>

### Function

| Name | Param | Returns | Description |
|---|---|---|---|
| `findScheduleCases` | result / schedules / selectedList / timeTable / count | - | 선택된 시간표 정보를 통해 가능한 모든 시간표 경우의 수 추출 |
| `canTakeit` | timeTable / $selectedList[$count] | boolean | 해당 시간에 이미 선택된 수업이 있는지 확인 |
| `paintSchedule` | timeTable, schedules, selectedList[count][i] | - | 해당 수업을 시간표에 추가 |
| `eraseSchedule` | timeTable, schedules, selectedList[count][i] | - | 새로운 경우의 수 추츨을 위해 수업 제거 |


### Source
```
/*선택된 시간표를 이용해 만들 수 있는 강의시간 경우의 수 추출*/
function findScheduleCases(&$result, &$schedules, &$selectedList, &$timeTable, $count){
    if($count == count($selectedList)){
        printResult($schedules);
        echo '<br>';
        array_push($result, $schedules); //result push
        return;
    }
    if(is_array($selectedList[$count])){
        for($i = 0; $i < count($selectedList[$count]); $i++){
            if(canTakeit($timeTable, $selectedList[$count][$i])){
                paintSchedule($timeTable, $schedules, $selectedList[$count][$i]);
                findScheduleCases($result, $schedules, $selectedList, $timeTable, $count + 1);
                eraseSchedule($timeTable, $schedules, $selectedList[$count][$i]);
            }
        } 
    }
    else if(canTakeit($timeTable, $selectedList[$count])){
        paintSchedule($timeTable, $schedules, $selectedList[$count]);
        findScheduleCases($result, $schedules, $selectedList, $timeTable, $count + 1);
        eraseSchedule($timeTable, $schedules, $selectedList[$count]);
    }
}
```

## 학식정보
  동아대학교 학식정보 제공

### Screen Shots
<p align="center"><img src="https://user-images.githubusercontent.com/45222982/93844004-c108c600-fcd6-11ea-8d0a-d69830603aa6.png" width="280" height="500"/> <img src="https://user-images.githubusercontent.com/45222982/93844005-c239f300-fcd6-11ea-9c60-be58bb901603.png" width="280" height="500"/></p>

### 식당 List
- 승학캠퍼스
  - 교수회관
  - 학생회관
  - 도서관
  
- 부민캠퍼스
  - 교수회관
  - 학생회관
  
- 한림생활관
  - 승학기숙사
  - 부민기숙사
  

## 전화번호부
  동아대학교 전화번호부정보 제공

### Screen Shots
<p align="center"><img src="https://user-images.githubusercontent.com/45222982/93844006-c2d28980-fcd6-11ea-9cae-fc48a82e6582.png" width="280" height="500"/></p>

## 학사일정
  동아대학교 학사일정정보 제공

### Screen Shots
<p align="center"><img src="https://user-images.githubusercontent.com/45222982/93844009-c2d28980-fcd6-11ea-823c-d59a4a09b6e6.png" width="280" height="500"/></p>
