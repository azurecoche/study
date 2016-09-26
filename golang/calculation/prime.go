package calcuration

import "fmt"

/**
 素数を求める
 [定義]
  ・ 1より大きい
  ・ 自身以外の数では割り切れない
 [前提条件]
  ・ 200決め打ちで算出（20160920時点）
 */
func Calcurate() {
	var primeTable [200]int
	max := len(primeTable)
	index := 0;

	for number := 2; number <= max; number++ {
		if isPrime(number) {
			primeTable[index] = number
			index++
		}
	}

	for i := 0; i < index; i++ {
		fmt.Print(primeTable[i], " ")
	}
}

/**
 * 素数か
 */
func isPrime(originalNumber int) bool {
	canDivided := false
	for num := 2; num < originalNumber; num++ {
		if isDivided(originalNumber, num) {
			canDivided = true
			break
		}
	}

	return (canDivided == false)
}

/**
 * 割り切れるか否か
 */
func isDivided(divisor int, dividend int) bool {
	return divisor % dividend == 0
}