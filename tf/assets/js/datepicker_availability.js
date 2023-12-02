 // Enable a range of dates
function enableRangeOfDays(d) {
    for (var i = 0; i < enableDaysRange.length; i++) {
        if ($.isArray(enableDaysRange[i])) {
            for (var j = 0; j < enableDaysRange[i].length; j++) {
                var r = enableDaysRange[i][j].split(" to ");
                r[0] = r[0].split("-");
                r[1] = r[1].split("-");
                if (new Date(r[0][2], (r[0][0] - 1), r[0][1]) <= d && d <= new Date(r[1][2], (r[1][0] - 1), r[1][1])) {
                    return [true];
                }
            }
        } else {
            if (((d.getMonth() + 1) + '-' + d.getDate() + '-' + d.getFullYear()) == enableDaysRange[i]) {
                return [true];
            }
        }
    }
    return [false];
}

// Enable a array of weekdays
function enableWeekday(date) {
    var day = date.getDay();
    for (i = 0; i < weekdays.length; i++) {
        if ($.inArray(day, weekdays) != -1) {
            return [true];
        }
    }
    return [false];
}



function disableAllTheseDays(date) {
		var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
		for (i = 0; i < disabledDays.length; i++) {
			if($.inArray((m+1) + '-' + d + '-' + y,disabledDays) != -1) {
				return [false];
			}
		}
		return [true];
	}
	
	 
 
function nationalDays(date, inMonth) { 
    if (inMonth) { 
        for (i = 0; i < natDays.length; i++) { 
            if (date.month() == natDays[i][0] && date.day() == natDays[i][1]) { 
                return {dateClass: natDays[i][2] + '_day', selectable: false}; 
            } 
        } 
    } 
    return {}; 
}

function highlightDaysh(date) {
        for (var i = 0; i < highlight.length; i++) {
            if (new Date(highlight[i]).toString() == date.toString()) {              
                          return [true, 'highlight', 'sdhaj'];
                  }
          }
          return [true, ''];

 } 
 
 var specialDays = {
			'2013': {
                '11': {'30': {tooltip: "New Year's Day", className: "highlight"}},
				'4': {
					'10': {tooltip: "Good Friday", className: "highlight"}, 
					'13': {tooltip: "Easter Monday", className: "highlight"}
				},
				'5': {
					'4': {tooltip: "Early May Bank Holiday", className: "highlight"},
					'15': {tooltip: "Spring Bank Holiday", className: "highlight"}
				},
				'8': {'31': {tooltip: "Summer Bank Holiday", className: "highlight"}},
				'12': {
					'25': {tooltip: "Christmas Day", className: "highlight"},
					'28': {tooltip: "Boxing Day", className: "highlight"}
				}
			},
		  '2014': {
			  '1':	{'1':	{tooltip: "New Year's Day", className: "highlight"}}}
		};
		
function highlightDays(date) {
    var  d = date.getDate(),
        m = date.getMonth()+1,
        y = date.getFullYear();
				
    if (specialDays[y] && specialDays[y][m] && specialDays[y][m][d]) {
        var s = specialDays[y][m][d];
        return [true, s.className, s.tooltip]; // selectable
    }
    return [true,'']; // non-selectable
}		
		
		