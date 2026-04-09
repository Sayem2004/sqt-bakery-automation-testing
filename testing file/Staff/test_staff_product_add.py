from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time
import random

driver = webdriver.Chrome()

try:
    print("Step 1: Staff Registration")

    driver.get("http://localhost/Bakery_Hub_new/common/View/register.php")
    driver.maximize_window()
    time.sleep(2)

    email = f"staff{random.randint(1000,9999)}@test.com"

    driver.find_element(By.ID, "name").send_keys("Staff User")
    driver.find_element(By.ID, "phone").send_keys("01811111111")
    driver.find_element(By.ID, "email").send_keys(email)
    driver.find_element(By.ID, "password").send_keys("123456")

    Select(driver.find_element(By.ID, "role")).select_by_value("staff")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Staff Registration Done")


    print("Step 2: Staff Login")

    driver.get("http://localhost/Bakery_Hub_new/common/View/login.php")
    time.sleep(2)

    driver.find_element(By.ID, "email").send_keys(email)
    driver.find_element(By.ID, "password").send_keys("123456")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Staff Login Done")


    print("Step 3: Add Product")

    driver.get("http://localhost/Bakery_Hub_new/staff/view/staff_dashboard.php")
    time.sleep(2)

    # Product info
    driver.find_element(By.NAME, "product_name").send_keys("Burger")
    driver.find_element(By.NAME, "price").send_keys("150")
    driver.find_element(By.NAME, "quantity").send_keys("10")

    driver.find_element(By.NAME, "mfg").send_keys("2026-04-01")
    driver.find_element(By.NAME, "exp").send_keys("2026-04-10")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Product Added Successfully")


    print("Step 4: Logout")

    driver.find_element(By.LINK_TEXT, "Logout").click()
    time.sleep(2)

    print("✅ Logout Done")

except Exception as e:
    print(" Error:", e)

finally:
    driver.quit()