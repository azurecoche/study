package calculation


// 与えられた数字の階乗を算出して返却する
func Execute(num int) int {
	result := 1
	for num > 0 {
		result = result * num
		num--
	}

	return result
}
